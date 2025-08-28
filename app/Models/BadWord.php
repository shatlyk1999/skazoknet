<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BadWord extends Model
{
    protected $table = 'bad_words';
    protected $guarded = ['id'];

    public function scopeFilter($query, $data = [])
    {
        if (isset($data['search'])) {
            $query->where('word', 'like', '%' . $data['search'] . '%');
        }

        if (isset($data['status'])) {
            $query->where('status', $data['status']);
        }
    }
}
