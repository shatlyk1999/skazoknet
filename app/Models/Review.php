<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Review extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'is_approved' => 'boolean',
        'include_in_rating' => 'boolean',
        'is_hidden' => 'boolean',
        'views' => 'integer',
        'likes' => 'integer',
        'dislikes' => 'integer',
        'rating' => 'integer'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function official_response(): HasOne
    {
        return $this->hasOne(OfficialResponse::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function reviewable(): MorphTo
    {
        return $this->morphTo();
    }

    public function images(): HasMany
    {
        return $this->hasMany(ReviewImage::class);
    }

    public function reviewLikes(): HasMany
    {
        return $this->hasMany(ReviewLike::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(ReviewLike::class)->where('type', 'like');
    }

    public function dislikes(): HasMany
    {
        return $this->hasMany(ReviewLike::class)->where('type', 'dislike');
    }

    public function getTotalLikesAttribute()
    {
        return $this->likes()->count() + ($this->likes ?? 0);
    }

    public function getTotalDislikesAttribute()
    {
        return $this->dislikes()->count() + ($this->dislikes ?? 0);
    }

    public function userLikeStatus($userId = null)
    {
        if (!$userId) return null;

        $like = $this->reviewLikes()->where('user_id', $userId)->first();
        return $like ? $like->type : null;
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    public function scopeIncludedInRating($query)
    {
        return $query->where('include_in_rating', true);
    }

    public function scopePositive($query)
    {
        return $query->where('type', 'positive');
    }

    public function scopeNegative($query)
    {
        return $query->where('type', 'negative');
    }

    public function scopeVisible($query)
    {
        return $query->where('is_hidden', false);
    }

    public function scopeHidden($query)
    {
        return $query->where('is_hidden', true);
    }

    public function scopeVisibleToUser($query, $userId = null)
    {
        return $query->where(function ($q) use ($userId) {
            $q->where('is_hidden', false)
                ->orWhere(function ($subQ) use ($userId) {
                    if ($userId) {
                        $subQ->where('is_hidden', true)
                            ->where('user_id', $userId);
                    }
                });
        });
    }

    public function incrementViews()
    {
        $this->increment('views');
    }

    public function incrementLikes()
    {
        $this->increment('likes');
    }

    public function incrementDislikes()
    {
        $this->increment('dislikes');
    }

    // Filter bad words
    public static function filterBadWords($text)
    {
        $badWords = BadWord::pluck('word')->toArray();

        foreach ($badWords as $badWord) {
            $pattern = '/\b' . preg_quote($badWord, '/') . '\b/iu';
            $replacement = str_repeat('*', mb_strlen($badWord));
            $text = preg_replace($pattern, $replacement, $text);
        }

        return $text;
    }

    // Check if review can be edited by user
    public function canBeEditedByUser($userId = null)
    {
        // Only admin can edit published reviews
        if ($this->is_approved) {
            return false;
        }

        // User can only edit their own unpublished reviews
        return $this->user_id === $userId;
    }

    // Check if review can be deleted by user
    public function canBeDeletedByUser($userId = null)
    {
        // Only admin can delete published reviews
        if ($this->is_approved) {
            return false;
        }

        // User can only delete their own unpublished reviews
        return $this->user_id === $userId;
    }

    // Get user's remaining daily review limit
    public static function getUserDailyRemainingLimit($userId)
    {
        $todayCount = self::where('user_id', $userId)
            ->whereDate('created_at', today())
            ->count();

        return max(0, 2 - $todayCount);
    }

    // Check if user can review this item
    public static function canUserReviewItem($userId, $reviewableId, $reviewableType)
    {
        return !self::where('user_id', $userId)
            ->where('reviewable_id', $reviewableId)
            ->where('reviewable_type', $reviewableType)
            ->exists();
    }

    // additions
    public function additions(): HasMany
    {
        return $this->hasMany(related: Addition::class, foreignKey: 'review_id');
    }

    //comments
    public function comments()
    {
        return $this->hasMany(ReviewComment::class);
    }
}
