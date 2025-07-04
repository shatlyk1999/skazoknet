<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';
    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function users()
    {
        return $this->hasMany(User::class, 'city_id');
    }

    public function developers()
    {
        return $this->belongsToMany(Developer::class, 'city_developers', 'city_id', 'developer_id')->withTimestamps();
    }

    public function complexes()
    {
        return $this->hasMany(Complex::class, 'city_id');
    }
}
