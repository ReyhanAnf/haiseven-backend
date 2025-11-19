<?php

namespace App\Exports;

use App\Models\LanguageLesson;
use App\Models\LanguageModule;
use App\Models\LanguageQuestion;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class LanguageModuleExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            'Modules' => new class implements FromCollection, WithHeadings {
                public function collection(): Collection
                {
                    return LanguageModule::query()
                        ->orderBy('order')
                        ->get()
                        ->map(function (LanguageModule $module) {
                            return [
                                'module_key' => Str::slug($module->title).'_'.$module->id,
                                'title' => $module->title,
                                'description' => $module->description,
                                'order' => $module->order,
                            ];
                        });
                }

                public function headings(): array
                {
                    return ['module_key', 'title', 'description', 'order'];
                }
            },
            'Lessons' => new class implements FromCollection, WithHeadings {
                public function collection(): Collection
                {
                    $lessons = LanguageLesson::with('module')->orderBy('module_id')->orderBy('order')->get();
                    return $lessons->map(function (LanguageLesson $lesson) {
                        return [
                            'module_key' => Str::slug($lesson->module->title).'_'.$lesson->module->id,
                            'lesson_key' => Str::slug($lesson->title).'_'.$lesson->id,
                            'title' => $lesson->title,
                            'order' => $lesson->order,
                        ];
                    });
                }

                public function headings(): array
                {
                    return ['module_key', 'lesson_key', 'title', 'order'];
                }
            },
            'Questions' => new class implements FromCollection, WithHeadings {
                public function collection(): Collection
                {
                    $questions = LanguageQuestion::with('lesson.module')->orderBy('lesson_id')->orderBy('id')->get();
                    return $questions->map(function (LanguageQuestion $q) {
                        return [
                            'lesson_key' => Str::slug($q->lesson->title).'_'.$q->lesson->id,
                            'question_type' => $q->question_type,
                            'question' => $q->question,
                            'correct_answer' => $q->correct_answer,
                            'options' => $q->options ? implode('|', $q->options) : null,
                        ];
                    });
                }

                public function headings(): array
                {
                    return ['lesson_key', 'question_type', 'question', 'correct_answer', 'options'];
                }
            },
        ];
    }
}
