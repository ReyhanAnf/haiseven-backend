<?php

namespace App\Imports;

use App\Models\LanguageLesson;
use App\Models\LanguageModule;
use App\Models\LanguageQuestion;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Throwable;

class LanguageModuleImport implements WithMultipleSheets
{
    /**
     * @var list<array{row:int,module_key:string,title:string,description:?string,order:int}>
     */
    private array $moduleRows = [];

    /**
     * @var list<array{row:int,module_key:string,lesson_key:string,title:string,order:int}>
     */
    private array $lessonRows = [];

    /**
     * @var list<array{row:int,lesson_key:string,question_type:string,question:string,correct_answer:string,options:?string}>
     */
    private array $questionRows = [];

    /**
     * @var array<string, int>
     */
    private array $moduleMap = [];

    /**
     * @var array<string, int>
     */
    private array $lessonMap = [];

    private bool $replaceExisting;

    /**
     * @var array{
     *     modules_created:int,
     *     modules_updated:int,
     *     lessons_created:int,
     *     lessons_updated:int,
     *     questions_created:int,
     *     questions_updated:int,
     *     errors:list<string>
     * }
     */
    private array $summary = [
        'modules_created' => 0,
        'modules_updated' => 0,
        'lessons_created' => 0,
        'lessons_updated' => 0,
        'questions_created' => 0,
        'questions_updated' => 0,
        'errors' => [],
    ];

    public function __construct(bool $replaceExisting = false)
    {
        $this->replaceExisting = $replaceExisting;
    }

    public function sheets(): array
    {
        return [
            'Modules' => new class($this) implements ToCollection, WithHeadingRow {
                public function __construct(private readonly LanguageModuleImport $parent)
                {
                }

                public function collection(Collection $rows): void
                {
                    foreach ($rows as $index => $row) {
                        if (!self::hasMeaningfulData($row)) {
                            continue;
                        }

                        $moduleKey = trim((string) ($row['module_key'] ?? ''));
                        $title = trim((string) ($row['title'] ?? ''));
                        $description = $row['description'] ?? null;
                        $order = self::toInt($row['order'] ?? null);

                        $this->parent->moduleRows[] = [
                            'row' => $index + 2,
                            'module_key' => $moduleKey,
                            'title' => $title,
                            'description' => $description !== null ? trim((string) $description) : null,
                            'order' => $order,
                        ];
                    }
                }

                private static function hasMeaningfulData(Collection $row): bool
                {
                    return $row->filter(fn ($value) => $value !== null && trim((string) $value) !== '')->isNotEmpty();
                }

                private static function toInt(mixed $value): int
                {
                    return max(0, (int) ($value ?? 0));
                }
            },
            'Lessons' => new class($this) implements ToCollection, WithHeadingRow {
                public function __construct(private readonly LanguageModuleImport $parent)
                {
                }

                public function collection(Collection $rows): void
                {
                    foreach ($rows as $index => $row) {
                        if (!self::hasMeaningfulData($row)) {
                            continue;
                        }

                        $this->parent->lessonRows[] = [
                            'row' => $index + 2,
                            'module_key' => trim((string) ($row['module_key'] ?? '')),
                            'lesson_key' => trim((string) ($row['lesson_key'] ?? '')),
                            'title' => trim((string) ($row['title'] ?? '')),
                            'order' => self::toInt($row['order'] ?? null),
                        ];
                    }
                }

                private static function hasMeaningfulData(Collection $row): bool
                {
                    return $row->filter(fn ($value) => $value !== null && trim((string) $value) !== '')->isNotEmpty();
                }

                private static function toInt(mixed $value): int
                {
                    return max(0, (int) ($value ?? 0));
                }
            },
            'Questions' => new class($this) implements ToCollection, WithHeadingRow {
                public function __construct(private readonly LanguageModuleImport $parent)
                {
                }

                public function collection(Collection $rows): void
                {
                    foreach ($rows as $index => $row) {
                        if (!self::hasMeaningfulData($row)) {
                            continue;
                        }

                        $this->parent->questionRows[] = [
                            'row' => $index + 2,
                            'lesson_key' => trim((string) ($row['lesson_key'] ?? '')),
                            'question_type' => trim((string) ($row['question_type'] ?? '')),
                            'question' => trim((string) ($row['question'] ?? '')),
                            'correct_answer' => trim((string) ($row['correct_answer'] ?? '')),
                            'options' => $row['options'] === null ? null : (string) $row['options'],
                        ];
                    }
                }

                private static function hasMeaningfulData(Collection $row): bool
                {
                    return $row->filter(fn ($value) => $value !== null && trim((string) $value) !== '')->isNotEmpty();
                }
            },
        ];
    }

    /**
     * @return array{modules_created:int,modules_updated:int,lessons_created:int,lessons_updated:int,questions_created:int,questions_updated:int,errors:list<string>}
     */
    public function persist(): array
    {
        DB::transaction(function (): void {
            if ($this->replaceExisting) {
                LanguageModule::query()->delete();
            }

            $this->storeModules();
            $this->storeLessons();
            $this->storeQuestions();
        });

        return $this->summary;
    }

    private function storeModules(): void
    {
        foreach ($this->moduleRows as $row) {
            if ($row['module_key'] === '') {
                $this->recordError('Modules', $row['row'], 'Kolom module_key wajib diisi.');
                continue;
            }

            if ($row['title'] === '') {
                $this->recordError('Modules', $row['row'], 'Kolom title wajib diisi.');
                continue;
            }

            try {
                $module = LanguageModule::updateOrCreate(
                    ['title' => $row['title']],
                    [
                        'description' => $row['description'],
                        'order' => $row['order'],
                    ]
                );

                $this->moduleMap[$row['module_key']] = $module->id;

                if ($module->wasRecentlyCreated) {
                    $this->summary['modules_created']++;
                } else {
                    $this->summary['modules_updated']++;
                }
            } catch (Throwable $exception) {
                $this->recordError('Modules', $row['row'], 'Gagal menyimpan modul: '.$exception->getMessage());
            }
        }
    }

    private function storeLessons(): void
    {
        foreach ($this->lessonRows as $row) {
            if ($row['lesson_key'] === '') {
                $this->recordError('Lessons', $row['row'], 'Kolom lesson_key wajib diisi.');
                continue;
            }

            if ($row['module_key'] === '') {
                $this->recordError('Lessons', $row['row'], 'Kolom module_key wajib diisi.');
                continue;
            }

            if ($row['title'] === '') {
                $this->recordError('Lessons', $row['row'], 'Kolom title wajib diisi.');
                continue;
            }

            $moduleId = $this->moduleMap[$row['module_key']] ?? null;
            if ($moduleId === null) {
                $this->recordError('Lessons', $row['row'], sprintf('Module key "%s" tidak ditemukan pada sheet Modules.', $row['module_key']));
                continue;
            }

            try {
                $lesson = LanguageLesson::updateOrCreate(
                    [
                        'module_id' => $moduleId,
                        'title' => $row['title'],
                    ],
                    [
                        'order' => $row['order'],
                    ]
                );

                $this->lessonMap[$row['lesson_key']] = $lesson->id;

                if ($lesson->wasRecentlyCreated) {
                    $this->summary['lessons_created']++;
                } else {
                    $this->summary['lessons_updated']++;
                }
            } catch (Throwable $exception) {
                $this->recordError('Lessons', $row['row'], 'Gagal menyimpan pelajaran: '.$exception->getMessage());
            }
        }
    }

    private function storeQuestions(): void
    {
        foreach ($this->questionRows as $row) {
            if ($row['lesson_key'] === '') {
                $this->recordError('Questions', $row['row'], 'Kolom lesson_key wajib diisi.');
                continue;
            }

            if ($row['question'] === '') {
                $this->recordError('Questions', $row['row'], 'Kolom question wajib diisi.');
                continue;
            }

            if ($row['correct_answer'] === '') {
                $this->recordError('Questions', $row['row'], 'Kolom correct_answer wajib diisi.');
                continue;
            }

            $lessonId = $this->lessonMap[$row['lesson_key']] ?? null;
            if ($lessonId === null) {
                $this->recordError('Questions', $row['row'], sprintf('Lesson key "%s" tidak ditemukan pada sheet Lessons.', $row['lesson_key']));
                continue;
            }

            $questionType = $this->normalizeQuestionType($row['question_type'], $row['row']);
            $options = $this->normalizeOptions($row['options'], $questionType);

            try {
                $question = LanguageQuestion::updateOrCreate(
                    [
                        'lesson_id' => $lessonId,
                        'question' => $row['question'],
                    ],
                    [
                        'question_type' => $questionType,
                        'correct_answer' => $row['correct_answer'],
                        'options' => $options,
                    ]
                );

                if ($question->wasRecentlyCreated) {
                    $this->summary['questions_created']++;
                } else {
                    $this->summary['questions_updated']++;
                }
            } catch (Throwable $exception) {
                $this->recordError('Questions', $row['row'], 'Gagal menyimpan soal: '.$exception->getMessage());
            }
        }
    }

    private function normalizeQuestionType(string $value, int $row): string
    {
        $type = strtolower($value);
        if (!in_array($type, ['multiple_choice', 'fill_in_blank'], true)) {
            $this->recordError('Questions', $row, sprintf('Tipe soal "%s" tidak dikenal. Default ke multiple_choice.', $value));
            return 'multiple_choice';
        }

        return $type;
    }

    /**
     * @return list<string>|null
     */
    private function normalizeOptions(?string $value, string $questionType): ?array
    {
        if ($questionType !== 'multiple_choice') {
            return null;
        }

        if ($value === null || trim($value) === '') {
            return null;
        }

        $parts = array_map('trim', explode('|', $value));
        $filtered = array_values(array_filter($parts, fn (string $option) => $option !== ''));

        return $filtered !== [] ? $filtered : null;
    }

    private function recordError(string $sheet, int $row, string $message): void
    {
        $prefix = $row > 0 ? sprintf('%s baris %d: ', $sheet, $row) : sprintf('%s: ', $sheet);
        $this->summary['errors'][] = $prefix.$message;
        Log::warning('[LanguageModuleImport] '.$prefix.$message);
    }
}
