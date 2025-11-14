<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DailyFocusItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'daily_focus_id',
        'content',
        'order',
        'completed',
    ];

    protected $casts = [
        'completed' => 'boolean',
    ];

    public function dailyFocus(): BelongsTo
    {
        return $this->belongsTo(DailyFocus::class);
    }
}
