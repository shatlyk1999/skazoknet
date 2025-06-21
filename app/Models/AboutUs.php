<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    protected $table = 'about_us';
    protected $guarded = ['id'];
    protected $hidden = [
        'title',
        'created_at',
        'updated_at',
    ];
}
