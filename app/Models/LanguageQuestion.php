<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LanguageQuestion extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'lesson_id',
        'question_type',
        'question',
        'options',
        'correct_answer',
    ];

    protected function casts(): array
    {
        return [
            'options' => 'array',
        ];
    }

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(LanguageLesson::class, 'lesson_id');
    }
}
