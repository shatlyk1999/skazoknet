<?php

namespace App\Models;

use App\Traits\HasSeo;
use Illuminate\Database\Eloquent\Model;

class Complex extends Model
{
    use HasSeo;

    protected $table = 'complexes';
    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at'];


    //relations
    public function developer()
    {
        return $this->belongsTo(Developer::class, 'developer_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function images()
    {
        return $this->hasMany(ComplexImage::class, 'complex_id');
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    public function approvedReviews()
    {
        return $this->reviews()->approved()->visible();
    }

    public function visibleReviews()
    {
        return $this->reviews()->approved()->visible();
    }

    public function scopeStatus()
    {
        return $this->where('status', '1');
    }

    public function scopeFilter($query, $data = [])
    {
        if (isset($data['search'])) {
            $query->where('name', 'like', '%' . $data['search'] . '%');
        }

        if (isset($data['popular']) && $data['popular'] == 'on') {
            $query->orderBy('popular', 'desc');
        }

        if (isset($data['type'])) {
            $query->where('type', $data['type']);
        }

        if (isset($data['city_id'])) {
            $query->where('city_id', $data['city_id']);
        }

        if (isset($data['developer_id'])) {
            $query->where('developer_id', $data['developer_id']);
        }

        if (isset($data['developer_slug'])) {
            $query->whereHas('developer', function ($q) use ($data) {
                $q->where('slug', $data['developer_slug']);
            });
        }

        if (isset($data['image'])) {
            if ($data['image'] == '1') {
                $query->where('image', '!=', null);
            }
            if ($data['image'] == '0') {
                $query->where('image', null);
            }
        }

        if (isset($data['images'])) {
            if ($data['images'] === 'with') {
                $query->whereHas('images');
            } elseif ($data['images'] === 'without') {
                $query->doesntHave('images');
            }
        }
        if (isset($data['popular'])) {
            $query->where('popular', $data['popular']);
        }
        if (isset($data['status'])) {
            $query->where('status', $data['status']);
        }
    }

    // SEO Methods
    protected function getDefaultSeoTitle()
    {
        return $this->name . ' - ' . $this->city?->name . ' | Жилой комплекс';
    }

    protected function getDefaultSeoDescription()
    {
        $description = 'Жилой комплекс ' . $this->name;
        if ($this->city) {
            $description .= ' в городе ' . $this->city->name;
        }
        if ($this->developer) {
            $description .= ' от застройщика ' . $this->developer->name . '.';
        }
        if ($this->description) {
            $description .= ' ' . substr(strip_tags($this->description), 0, 100) . '...';
        }
        return $description;
    }

    protected function getDefaultSeoKeywords()
    {
        $keywords = [$this->name, 'недвижимость', 'жилой комплекс', 'новостройки'];
        if ($this->city) {
            $keywords[] = $this->city->name;
        }
        if ($this->developer) {
            $keywords[] = $this->developer->name;
        }
        if ($this->type) {
            $keywords[] = $this->type;
        }
        return implode(', ', $keywords);
    }

    protected function getDefaultOgImage()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    protected function getDefaultCanonicalUrl()
    {
        return route('show.complex', $this->slug);
    }

    // // Calculate average rating from reviews
    // public function getAverageRatingAttribute()
    // {
    //     $reviews = $this->reviews()->whereIn('is_approved', [0, 2])->where('is_hidden', false)->where('include_in_rating', true);

    //     if ($reviews->count() == 0) {
    //         return 0;
    //     }

    //     $totalPoints = 0;
    //     $totalReviews = 0;

    //     foreach ($reviews->get() as $review) {
    //         $totalPoints += $review->rating;
    //         $totalReviews++;
    //     }

    //     if ($totalReviews == 0) {
    //         return 0;
    //     }

    //     return round($totalPoints / $totalReviews, 2);
    // }

    // // Get rating breakdown (how many reviews for each star)
    // public function getRatingBreakdownAttribute()
    // {
    //     $reviews = $this->reviews()->whereIn('is_approved', [0, 2])->where('is_hidden', false)->where('include_in_rating', true);

    //     $breakdown = [
    //         5 => 0,
    //         4 => 0,
    //         3 => 0,
    //         2 => 0,
    //         1 => 0
    //     ];

    //     foreach ($reviews->get() as $review) {
    //         if (isset($breakdown[$review->rating])) {
    //             $breakdown[$review->rating]++;
    //         }
    //     }

    //     return $breakdown;
    // }

    // // Get total approved reviews count
    // public function getApprovedReviewsCountAttribute()
    // {
    //     return $this->reviews()->whereIn('is_approved', [0, 2])->where('is_hidden', false)->where('include_in_rating', true)->count();
    // }
}
