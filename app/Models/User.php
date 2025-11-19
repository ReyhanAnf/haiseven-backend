<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\GratitudeEntry;
use App\Models\LanguageLabDailyUsage;
use App\Models\Post;
use App\Models\Subscription;
use App\Models\UpgradePromptEvent;
use App\Models\VocabularyEntry;
use Illuminate\Support\Carbon;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'bio',
        'timezone',
        'preferences',
        'plan',
        'is_pro',
        'pro_expires_at',
    'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'preferences' => 'array',
            'is_pro' => 'boolean',
            'is_admin' => 'boolean',
            'pro_expires_at' => 'datetime',
        ];
    }

    /**
     * Get all gratitude entries for the user.
     */
    public function gratitudeEntries()
    {
        return $this->hasMany(GratitudeEntry::class);
    }

    public function upgradePromptEvents()
    {
        return $this->hasMany(UpgradePromptEvent::class);
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'author_id');
    }

    public function vocabularyEntries(): HasMany
    {
        return $this->hasMany(VocabularyEntry::class);
    }

    public function languageLabDailyUsages(): HasMany
    {
        return $this->hasMany(LanguageLabDailyUsage::class);
    }

    /**
     * Ensure subscription related flags stay consistent with expiry.
     */
    public function refreshSubscriptionStatus(): void
    {
        if (! $this->is_pro) {
            return;
        }

        $expiresAt = $this->pro_expires_at instanceof Carbon ? $this->pro_expires_at : ($this->pro_expires_at ? Carbon::parse($this->pro_expires_at) : null);

        if ($expiresAt && $expiresAt->isPast()) {
            $this->forceFill([
                'is_pro' => false,
                'plan' => $this->plan === 'pro' ? 'free' : $this->plan,
                'pro_expires_at' => null,
            ])->save();
        }
    }
}
