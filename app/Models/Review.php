<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'complex_id',
        'type', // positive|negative|neutral
        'rating',
        'title',
        'text',
        'is_approved',
    ];

    protected $casts = [
        'is_approved' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function complex()
    {
        return $this->belongsTo(Complex::class);
    }

    public function additions()
    {
        return $this->hasMany(ReviewAddition::class);
    }
}

