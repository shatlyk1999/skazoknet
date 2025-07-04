<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complex extends Model
{
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
}
