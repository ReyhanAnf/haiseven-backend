<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreativePrompt extends Model
{
    use HasFactory;

    protected $fillable = [
        'prompt_text',
    ];
}
