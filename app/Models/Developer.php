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
        if (isset($data['popular'])) {
            $query->where('popular', $data['popular']);
        }
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
}
