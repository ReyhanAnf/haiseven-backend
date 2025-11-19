<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class LanguageModuleTemplateExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            'Modules' => new class implements FromCollection, WithHeadings {
                public function collection(): Collection
                {
                    return new Collection([
                        [
                            'module_key' => 'module_basic_conversation',
                            'title' => 'Percakapan Dasar',
                            'description' => 'Perkenalan kalimat sapaan dan ungkapan dasar.',
                            'order' => 1,
                        ],
                    ]);
                }

                public function headings(): array
                {
                    return [
                        'module_key',
                        'title',
                        'description',
                        'order',
                    ];
                }
            },
            'Lessons' => new class implements FromCollection, WithHeadings {
                public function collection(): Collection
                {
                    return new Collection([
                        [
                            'module_key' => 'module_basic_conversation',
                            'lesson_key' => 'lesson_greetings',
                            'title' => 'Sapaan & Salam',
                            'order' => 1,
                        ],
                    ]);
                }

                public function headings(): array
                {
                    return [
                        'module_key',
                        'lesson_key',
                        'title',
                        'order',
                    ];
                }
            },
            'Questions' => new class implements FromCollection, WithHeadings {
                public function collection(): Collection
                {
                    return new Collection([
                        [
                            'lesson_key' => 'lesson_greetings',
                            'question_type' => 'multiple_choice',
                            'question' => 'Apa terjemahan "Good morning" dalam Bahasa Indonesia?',
                            'correct_answer' => 'Selamat pagi',
                            'options' => 'Selamat pagi|Selamat malam|Terima kasih|Sampai jumpa',
                        ],
                        [
                            'lesson_key' => 'lesson_greetings',
                            'question_type' => 'fill_in_blank',
                            'question' => 'Lengkapi kalimat: "Nice to ____ you"',
                            'correct_answer' => 'meet',
                            'options' => null,
                        ],
                    ]);
                }

                public function headings(): array
                {
                    return [
                        'lesson_key',
                        'question_type',
                        'question',
                        'correct_answer',
                        'options',
                    ];
                }
            },
        ];
    }
}
