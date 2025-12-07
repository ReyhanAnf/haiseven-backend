<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'color',
    ];
}
