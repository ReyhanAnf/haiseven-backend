<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThoughtNode extends Model
{
    use HasFactory;

    protected $fillable = [
        'map_id',
        'content',
        'position_x',
        'position_y',
        'color',
        'connections',
        'image_url',
    ];

    protected $casts = [
        'position_x' => 'float',
        'position_y' => 'float',
        'connections' => 'array',
        'image_url' => 'string',
    ];

    public function map()
    {
        return $this->belongsTo(ThoughtMap::class, 'map_id');
    }
}
