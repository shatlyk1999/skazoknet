<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Addition extends Model
{
    protected $table = 'additions';
    protected $guarded = ['id'];

    public function review(): BelongsTo
    {
        return $this->belongsTo(related: Review::class, foreignKey: 'review_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(related: User::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(related: AdditionImage::class);
    }

    public function scopeApproved($query): mixed
    {
        return $query->where('is_approved', true);
        // ->where('is_hidden', false);
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
}
