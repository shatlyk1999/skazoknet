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

    protected $fillable = [
        'name',
        'content',
        'address',
        'sort',
        'status',
        'popular',
        'city_id',
        'developer_id',
        'type',
        'slug',
        'image',
        'map_x',
        'map_y'
    ];

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
}
