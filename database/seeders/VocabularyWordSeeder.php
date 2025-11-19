<?php

namespace Database\Seeders;

use App\Models\VocabularyWord;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class VocabularyWordSeeder extends Seeder
{
    /**
     * Seed the application's vocabulary words table.
     */
    public function run(): void
    {
        $path = database_path('seeders/data/vocabulary_words.php');

        if (! File::exists($path)) {
            $this->command?->warn('Vocabulary word dataset not found. Skipping VocabularyWordSeeder.');
            return;
        }

        /** @var array<int, array{word: string, definition: string, example_sentence: string}> $words */
        $words = include $path;

        if (empty($words)) {
            $this->command?->warn('Vocabulary word dataset empty. Skipping VocabularyWordSeeder.');
            return;
        }

        $now = Carbon::now();
        $chunks = array_chunk($words, 100);

        foreach ($chunks as $chunk) {
            $payload = array_map(static function (array $word) use ($now) {
                return [
                    'word' => $word['word'],
                    'definition' => $word['definition'],
                    'example_sentence' => $word['example_sentence'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }, $chunk);

            DB::table('vocabulary_words')->upsert(
                $payload,
                ['word'],
                ['definition', 'example_sentence', 'updated_at']
            );
        }

        $this->command?->info(sprintf('Seeded %d vocabulary words.', count($words)));
    }
}
