<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfficialResponse extends Model
{
    protected $table = "official_responses";
    protected $guarded = ["id"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function review()
    {
        return $this->belongsTo(Review::class);
    }

    public function images()
    {
        return $this->hasMany(OfficialResponseImage::class);
    }
}
