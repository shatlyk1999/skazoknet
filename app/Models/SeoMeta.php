<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoMeta extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'schema_markup' => 'array',
    ];

    public function seoable()
    {
        return $this->morphTo();
    }
}
