<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    protected $table = 'accesses';
    protected $guarded = ['id'];

    public function scopeFilter($query, $data = [])
    {
        if (isset($data['status'])) {
            $query->where('status', $data['status']);
        }

        if (isset($data['search'])) {
            $query->where(function ($q) use ($data) {
                $q->where('company_name', 'like', '%' . $data['search'] . '%')
                    ->orWhere('email', 'like', '%' . $data['search'] . '%')
                    ->orWhere('company_code', 'like', '%' . $data['search'] . '%');
            });
        }
    }
}
