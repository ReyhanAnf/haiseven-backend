<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LanguageLesson extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'module_id',
        'title',
        'order',
    ];

    public function module(): BelongsTo
    {
        return $this->belongsTo(LanguageModule::class, 'module_id');
    }

    public function questions(): HasMany
    {
        return $this->hasMany(LanguageQuestion::class, 'lesson_id')->orderBy('id');
    }

    public function progressRecords(): HasMany
    {
        return $this->hasMany(LessonProgress::class, 'lesson_id');
    }
}
