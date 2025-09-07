<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Notifications\CustomVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function sendEmailVerificationNotification()
    {
        try {
            $this->notify(new CustomVerifyEmail);
        } catch (\Exception $e) {
            // Ignore SMTP errors in local development
            Log::info('Email verification notification failed (ignored): ' . $e->getMessage());
        }
    }

    public function sendPasswordResetNotification($token)
    {
        try {
            $this->notify(new \App\Notifications\CustomResetPassword($token));
        } catch (\Exception $e) {
            // Ignore SMTP errors in local development
            Log::info('Password reset notification failed (ignored): ' . $e->getMessage());
        }
    }


    public function scopeIsUser($query)
    {
        return $query->where('role', '!=', 'superadmin');
    }

    //relatinons

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }


    public function developer()
    {
        return $this->hasOne(Developer::class, 'user_id');
    }

    public function scopeFilter($query, $data)
    {
        if (isset($data['role'])) {
            $query->where('role', $data['role']);
        }
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function comments()
    {
        return $this->hasMany(ReviewComment::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class, 'user_id');
    }
}
