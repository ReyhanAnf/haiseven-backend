<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContentItem extends Model
{
    protected $fillable = [
        'title',
        'status',
        'platform_tiktok',
        'platform_reels',
        'platform_shorts',
        'google_drive_link',
        'script_body',
        'generated_hooks',
        'generated_visual_prompts',
        'generated_captions',
        'batch_id',
        'category_id',
    ];

    protected $casts = [
        'platform_tiktok' => 'boolean',
        'platform_reels' => 'boolean',
        'platform_shorts' => 'boolean',
        'generated_hooks' => 'array',
    ];

    public function batch(): BelongsTo
    {
        return $this->belongsTo(ContentBatch::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ContentCategory::class);
    }
}
