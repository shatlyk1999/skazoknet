<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfficialResponseImage extends Model
{
    protected $table = "official_response_images";
    protected $guarded = ["id"];


    public $timestamps = false;

    public function official_response()
    {
        return $this->belongsTo(OfficialResponse::class);
    }
}
