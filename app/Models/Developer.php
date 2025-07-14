<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
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
    }
}
