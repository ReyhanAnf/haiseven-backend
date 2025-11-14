<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GratitudeEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'content',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string,string>
     */
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
