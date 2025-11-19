<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VocabularyWord extends Model
{
    use HasFactory;

    protected $fillable = [
        'word',
        'definition',
        'example_sentence',
    ];
}
