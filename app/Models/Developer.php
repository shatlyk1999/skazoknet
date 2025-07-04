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
}
