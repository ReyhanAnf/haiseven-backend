<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LanguageModule extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'description',
        'order',
    ];

    public function lessons(): HasMany
    {
        return $this->hasMany(LanguageLesson::class, 'module_id')->orderBy('order');
    }
}
