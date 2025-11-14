<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DailyFocus extends Model
{
    use HasFactory;

    protected $table = 'daily_focuses';

    protected $fillable = [
        'user_id',
        'focus_1',
        'focus_2',
        'focus_3',
        'date',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(DailyFocusItem::class)->orderBy('order');
    }
}
