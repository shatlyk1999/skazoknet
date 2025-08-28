<?php

namespace App\Models;

use App\Traits\HasSeo;
use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    use HasSeo;

    protected $table = 'developers';
    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function cities()
    {
        return $this->belongsToMany(City::class, 'city_developers', 'developer_id', 'city_id')->withTimestamps();
    }

    public function syncCities($developers)
    {
        return $this->cities()->sync($developers);
    }

    public function complexes()
    {
        return $this->hasMany(Complex::class, 'developer_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
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

        if (isset($data['name_year'])) {
            $query->where('name', 'like', '%' . $data['name_year'] . '%')
                ->orWhere('year_establishment', 'like', '%' . $data['name_year'] . '%');
        }

        if (isset($data['city_id'])) {
            $query->whereHas('cities', function ($q) use ($data) {
                $q->where('city_id', $data['city_id']);
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
        // if (isset($data['popular'])) {
        //     $query->where('popular', $data['popular']);
        // }
        if (isset($data['status'])) {
            $query->where('status', $data['status']);
        }
        if (isset($data['user_id'])) {
            $query->where('user_id', $data['user_id']);
        }
    }

    // SEO Methods
    protected function getDefaultSeoTitle()
    {
        return $this->name . ' - Застройщик | Проекты и комплексы';
    }

    protected function getDefaultSeoDescription()
    {
        $description = 'Застройщик ' . $this->name;
        if ($this->year_establishment) {
            $description .= ', основан в ' . $this->year_establishment . ' году.';
        }
        if ($this->description) {
            $description .= ' ' . substr(strip_tags($this->description), 0, 100) . '...';
        }
        return $description;
    }

    protected function getDefaultSeoKeywords()
    {
        $keywords = [$this->name, 'застройщик', 'строительная компания', 'жилые проекты'];
        if ($this->year_establishment) {
            $keywords[] = $this->year_establishment;
        }
        return implode(', ', $keywords);
    }

    protected function getDefaultOgImage()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    protected function getDefaultCanonicalUrl()
    {
        return route('show.developer', $this->slug);
    }

    // // Calculate average rating from reviews
    // public function getAverageRatingAttribute()
    // {
    //     $reviews = $this->reviews()->where('is_approved', true)->where('include_in_rating', true);

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
    //     $reviews = $this->reviews()->where('is_approved', true)->where('include_in_rating', true);

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
    //     return $this->reviews()->where('is_approved', true)->where('include_in_rating', true)->count();
    // }
}
