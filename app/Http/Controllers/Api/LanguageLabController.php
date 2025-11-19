<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LanguageLabDailyUsage;
use App\Models\User;
use App\Models\VocabularyEntry;
use App\Models\VocabularyWord;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class LanguageLabController extends Controller
{
    /**
     * List the authenticated user's saved vocabulary entries.
     */
    public function indexVocab(Request $request): JsonResponse
    {
        $entries = VocabularyEntry::query()
            ->where('user_id', $request->user()->id)
            ->latest('created_at')
            ->get();

        return response()->json($entries);
    }

    /**
     * Store a new vocabulary entry for the authenticated user.
     */
    public function storeVocab(Request $request): JsonResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'term' => ['required', 'string', 'max:255'],
            'meaning' => ['required', 'string', 'max:1000'],
            'note' => ['nullable', 'string', 'max:1000'],
        ]);

        $entry = $user->vocabularyEntries()->create($validated);

        return response()->json([
            'entry' => $entry,
        ], Response::HTTP_CREATED);
    }

    /**
     * Delete a vocabulary entry owned by the authenticated user.
     */
    public function destroyVocab(Request $request, int $entry): JsonResponse
    {
        $record = VocabularyEntry::query()
            ->where('user_id', $request->user()->id)
            ->findOrFail($entry);

        $record->delete();

        return response()->json([
            'deleted' => true,
        ]);
    }

    /**
     * Return remaining grammar checks for the current day.
     */
    public function usage(Request $request): JsonResponse
    {
        $user = $request->user();
        $limit = $this->grammarLimitForUser($user);
        $usage = $this->resolveUsageForToday($user);

        return response()->json([
            'remaining_checks' => max(0, $limit - $usage->grammar_checks_used),
            'limit_per_day' => $limit,
        ]);
    }

    /**
     * Perform a grammar check using LanguageTool (or compatible) API.
     */
    public function grammarCheck(Request $request): JsonResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'text' => ['required', 'string', 'max:5000'],
            'language' => ['nullable', 'string', 'max:10'],
            'variant' => ['nullable', 'string', 'max:10'],
        ]);

        $text = trim($validated['text']);
        if ($text === '') {
            return response()->json([
                'message' => 'Teks tidak boleh kosong.',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $limit = $this->grammarLimitForUser($user);
        $usage = $this->resolveUsageForToday($user);

        if ($usage->grammar_checks_used >= $limit) {
            return response()->json([
                'message' => 'Batas cek grammar hari ini tercapai.',
                'remaining_checks' => 0,
                'limit_per_day' => $limit,
            ], Response::HTTP_TOO_MANY_REQUESTS);
        }

        $language = $validated['language'] ?? config('services.languagetool.language', 'auto');
        $variant = $validated['variant'] ?? config('services.languagetool.variant', 'en-US');
        $endpoint = config('services.languagetool.url', 'https://api.languagetool.org/v2/check');

        $started = microtime(true);

        try {
            $response = Http::asForm()
                ->timeout((int) config('services.languagetool.timeout', 12))
                ->post($endpoint, array_filter([
                    'text' => $text,
                    'language' => $language,
                    'preferVariant' => $variant,
                ]));
        } catch (Throwable $exception) {
            Log::warning('LanguageTool request failed.', [
                'error' => $exception->getMessage(),
            ]);

            return response()->json([
                'message' => 'Layanan grammar checker sedang sibuk. Coba lagi dalam beberapa saat.',
                'remaining_checks' => max(0, $limit - $usage->grammar_checks_used),
                'limit_per_day' => $limit,
            ], Response::HTTP_BAD_GATEWAY);
        }

        if ($response->status() === Response::HTTP_TOO_MANY_REQUESTS) {
            return response()->json([
                'message' => 'Grammar checker sedang sibuk. Silakan coba lagi nanti.',
                'remaining_checks' => max(0, $limit - $usage->grammar_checks_used),
                'limit_per_day' => $limit,
            ], Response::HTTP_TOO_MANY_REQUESTS);
        }

        if ($response->failed()) {
            Log::warning('LanguageTool response error.', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return response()->json([
                'message' => 'Gagal terhubung ke layanan grammar checker.',
                'remaining_checks' => max(0, $limit - $usage->grammar_checks_used),
                'limit_per_day' => $limit,
            ], Response::HTTP_BAD_GATEWAY);
        }

        $payload = $response->json();
        $matches = $payload['matches'] ?? [];
        $sortedMatches = collect($matches)
            ->sortBy(fn (array $match) => $match['offset'] ?? 0)
            ->values()
            ->all();

        $issues = collect($sortedMatches)
            ->map(function (array $match) {
                $replacements = collect($match['replacements'] ?? [])
                    ->pluck('value')
                    ->filter()
                    ->take(5)
                    ->values()
                    ->all();

                return [
                    'id' => $match['rule']['id'] ?? Str::uuid()->toString(),
                    'offset' => (int) ($match['offset'] ?? 0),
                    'length' => (int) ($match['length'] ?? 0),
                    'message' => $match['message'] ?? '',
                    'replacements' => $replacements,
                    'rule' => $match['rule']['description'] ?? null,
                    'severity' => $this->mapIssueSeverity($match['rule']['issueType'] ?? null),
                ];
            })
            ->values()
            ->all();

        $correctedText = $this->buildCorrectedText($text, $sortedMatches);

        $usage->forceFill([
            'grammar_checks_used' => $usage->grammar_checks_used + 1,
        ])->save();
        $usage->refresh();

        $remaining = max(0, $limit - $usage->grammar_checks_used);
        $latency = (int) round((microtime(true) - $started) * 1000);

        return response()->json([
            'issues' => $issues,
            'corrected_text' => $correctedText,
            'remaining_checks' => $remaining,
            'limit_per_day' => $limit,
            'latency_ms' => $latency,
        ]);
    }

    /**
     * Return the Word of the Day feed (supports ?limit for carousel data).
     */
    public function wordOfTheDay(Request $request): JsonResponse
    {
        $user = $request->user();
        $timezone = $user?->timezone ?: config('app.timezone');

        $limitParam = (int) $request->query('limit', 1);
        $limit = max(1, min($limitParam, 14));

        $targetDate = $this->resolveTargetDate($request->query('date'), $timezone);

        $entries = [];
        for ($offset = 0; $offset < $limit; $offset++) {
            $cursorDate = $targetDate->copy()->subDays($offset);
            $resolved = $this->resolveWordForDate($cursorDate->toDateString());

            if ($resolved === null) {
                continue;
            }

            [$word, $index, $total] = $resolved;

            $entries[] = [
                'date' => $cursorDate->toDateString(),
                'word' => $word,
                'meta' => [
                    'index' => $index,
                    'total_words' => $total,
                    'selection_strategy' => 'crc32(date) % total_words',
                ],
            ];
        }

        if (empty($entries)) {
            return response()->json([
                'message' => 'Word of the Day is unavailable. Please seed vocabulary words first.',
            ], Response::HTTP_NOT_FOUND);
        }

        $wordsPayload = array_map(function (array $entry) use ($timezone) {
            /** @var VocabularyWord $model */
            $model = $entry['word'];

            return [
                'date' => $entry['date'],
                'timezone' => $timezone,
                'word' => [
                    'term' => $model->word,
                    'definition' => $model->definition,
                    'example_sentence' => $model->example_sentence,
                ],
                'meta' => $entry['meta'],
            ];
        }, $entries);

        $primaryEntry = $entries[0];
        /** @var VocabularyWord $primaryWordModel */
        $primaryWordModel = $primaryEntry['word'];

        $image = $user?->is_pro ? $this->resolveProImage($primaryWordModel, $primaryEntry['date']) : null;

        $primaryWord = $wordsPayload[0];
        if ($image !== null) {
            $primaryWord['image'] = $image;
        }

        return response()->json([
            'date' => $primaryEntry['date'],
            'timezone' => $timezone,
            'word' => $primaryWord,
            'words' => $wordsPayload,
            'image' => $image,
        ]);
    }

    /**
     * Determine the Carbon instance for the requested (or current) date.
     */
    protected function resolveTargetDate(?string $requestedDate, string $timezone): Carbon
    {
        try {
            return $requestedDate
                ? Carbon::parse($requestedDate, $timezone)->startOfDay()
                : Carbon::now($timezone)->startOfDay();
        } catch (Throwable $exception) {
            Log::notice('Invalid word-of-day preview date supplied; defaulting to today.', [
                'requested_date' => $requestedDate,
                'error' => $exception->getMessage(),
            ]);

            return Carbon::now($timezone)->startOfDay();
        }
    }

    /**
     * Resolve the word for a specific date.
     *
     * @return array{0: VocabularyWord, 1: int, 2: int}|null
     */
    protected function resolveWordForDate(string $dateKey): ?array
    {
        $totalWords = Cache::remember('vocabulary_words:total', now()->addHours(6), function () {
            return VocabularyWord::count();
        });

        if ($totalWords === 0) {
            return null;
        }

        $index = $this->determineIndex($dateKey, $totalWords);
        $cacheKey = "word_of_day:{$dateKey}:{$index}";

        $word = Cache::remember($cacheKey, now()->addDay(), function () use ($index) {
            return VocabularyWord::orderBy('word')->skip($index)->first();
        });

        if ($word === null) {
            return null;
        }

        return [$word, $index, $totalWords];
    }

    /**
     * Compute the index of the vocabulary word for a date.
     */
    protected function determineIndex(string $dateKey, int $totalWords): int
    {
        $hash = crc32($dateKey);

        return (int) ($hash % $totalWords);
    }

    /**
     * Fetch an illustration for PRO users, if configured.
     */
    protected function resolveProImage(VocabularyWord $word, string $dateKey): ?array
    {
        $accessKey = config('services.unsplash.access_key');

        if (empty($accessKey)) {
            return null;
        }

        $cacheKey = "word_of_day:image:{$word->id}:{$dateKey}";

        return Cache::remember($cacheKey, now()->addDay(), function () use ($word, $accessKey) {
            try {
                $response = Http::timeout(6)
                    ->acceptJson()
                    ->get('https://api.unsplash.com/photos/random', [
                        'query' => $word->word,
                        'orientation' => 'landscape',
                        'content_filter' => 'high',
                        'client_id' => $accessKey,
                    ]);

                if ($response->failed()) {
                    Log::warning('Failed to fetch Unsplash illustration for word of the day.', [
                        'word' => $word->word,
                        'status' => $response->status(),
                        'body' => $response->body(),
                    ]);

                    return null;
                }

                $data = $response->json();

                if (! is_array($data) || empty($data['urls']['regular'])) {
                    return null;
                }

                return [
                    'url' => $data['urls']['regular'] ?? null,
                    'thumbnail' => $data['urls']['small'] ?? null,
                    'description' => $data['description'] ?? $data['alt_description'] ?? null,
                    'photographer' => $data['user']['name'] ?? null,
                    'photographer_profile' => $data['user']['links']['html'] ?? null,
                    'unsplash_link' => $data['links']['html'] ?? null,
                    'attribution' => 'Photos provided by Unsplash',
                ];
            } catch (Throwable $exception) {
                Log::warning('Unexpected error while requesting Unsplash image.', [
                    'word' => $word->word,
                    'error' => $exception->getMessage(),
                ]);

                return null;
            }
        });
    }

    /**
     * Map LanguageTool issue types to UI severities.
     */
    protected function mapIssueSeverity(?string $issueType): string
    {
        return match ($issueType) {
            'misspelling', 'typographical' => 'error',
            'style' => 'info',
            'grammar' => 'warning',
            default => 'warning',
        };
    }

    /**
     * Build a corrected sentence by applying the first suggestion of each issue.
     *
     * @param array<int, array<string, mixed>> $matches
     */
    protected function buildCorrectedText(string $text, array $matches): string
    {
        if ($text === '' || empty($matches)) {
            return $text;
        }

        usort($matches, fn (array $a, array $b) => ($a['offset'] ?? 0) <=> ($b['offset'] ?? 0));

        $segments = [];
        $cursor = 0;
        $length = mb_strlen($text);

        foreach ($matches as $match) {
            $offset = max(0, (int) ($match['offset'] ?? 0));
            $matchLength = max(0, (int) ($match['length'] ?? 0));

            if ($offset > $cursor) {
                $segments[] = mb_substr($text, $cursor, $offset - $cursor);
            }

            $replacement = $match['replacements'][0]['value'] ?? null;
            if ($replacement !== null && $replacement !== '') {
                $segments[] = $replacement;
            } else {
                $segments[] = mb_substr($text, $offset, $matchLength);
            }

            $cursor = $offset + $matchLength;
        }

        if ($cursor < $length) {
            $segments[] = mb_substr($text, $cursor);
        }

        return implode('', $segments);
    }

    /**
     * Determine the per-day grammar check limit for a user.
     */
    protected function grammarLimitForUser(User $user): int
    {
        return $user->is_pro ? 25 : 10;
    }

    /**
     * Resolve (or create) today's usage record for the user using their timezone.
     */
    protected function resolveUsageForToday(User $user): LanguageLabDailyUsage
    {
        $timezone = $user->timezone ?: config('app.timezone');
        $date = Carbon::now($timezone)->toDateString();

        return LanguageLabDailyUsage::firstOrCreate(
            [
                'user_id' => $user->id,
                'usage_date' => $date,
            ],
            [
                'grammar_checks_used' => 0,
            ]
        );
    }
}
