<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewComment extends Model
{
    protected $table = 'review_comments';
    protected $guarded = ['id'];

    public function review()
    {
        return $this->belongsTo(Review::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
