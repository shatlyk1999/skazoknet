<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdditionImage extends Model
{
    protected $table = 'addition_images';
    protected $guarded = ['id'];

    public function addition(): BelongsTo
    {
        return $this->belongsTo(related: Addition::class);
    }
}