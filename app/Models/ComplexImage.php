<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComplexImage extends Model
{
    protected $table = 'complex_images';
    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function complex()
    {
        return $this->belongsTo(Complex::class, 'complex_id');
    }
}
