<?php

namespace Tests\Feature;

use App\Imports\LanguageModuleImport;
use App\Models\LanguageLesson;
use App\Models\LanguageModule;
use App\Models\LanguageQuestion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class LanguageModuleImportTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_imports_modules_lessons_and_questions_from_excel(): void
    {
        // Build a temporary workbook with three sheets matching template headings
        $spreadsheet = new Spreadsheet();

        // Modules sheet
        $modulesSheet = $spreadsheet->getActiveSheet();
        $modulesSheet->setTitle('Modules');
        $modulesSheet->fromArray([
            ['module_key', 'title', 'description', 'order'],
            ['module_intro', 'Perkenalan', 'Deskripsi singkat', 1],
        ]);

        // Lessons sheet
        $lessonsSheet = $spreadsheet->createSheet();
        $lessonsSheet->setTitle('Lessons');
        $lessonsSheet->fromArray([
            ['module_key', 'lesson_key', 'title', 'order'],
            ['module_intro', 'lesson_basic', 'Dasar', 1],
        ]);

        // Questions sheet
        $questionsSheet = $spreadsheet->createSheet();
        $questionsSheet->setTitle('Questions');
        $questionsSheet->fromArray([
            ['lesson_key', 'question_type', 'question', 'correct_answer', 'options'],
            ['lesson_basic', 'multiple_choice', 'Apa arti "Hello"?', 'Halo', 'Halo|Selamat|Hai'],
            ['lesson_basic', 'fill_in_blank', 'Lengkapi: Good ____', 'morning', null],
        ]);

        // Store to temp path
        $tempPath = storage_path('framework/testing/language-module-import.xlsx');
        (new Xlsx($spreadsheet))->save($tempPath);

        $import = new LanguageModuleImport();
        Excel::import($import, $tempPath);
        $summary = $import->persist();

        $this->assertEquals(1, $summary['modules_created']);
        $this->assertEquals(1, $summary['lessons_created']);
        $this->assertEquals(2, $summary['questions_created']);
        $this->assertEmpty($summary['errors']);

        $this->assertDatabaseHas('language_modules', ['title' => 'Perkenalan']);
        $this->assertDatabaseHas('language_lessons', ['title' => 'Dasar']);
        $this->assertDatabaseHas('language_questions', ['question' => 'Apa arti "Hello"?']);
        $this->assertDatabaseHas('language_questions', ['question' => 'Lengkapi: Good ____']);
    }
}
