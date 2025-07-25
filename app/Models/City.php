<?php

namespace App\Models;

use App\Traits\HasSeo;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasSeo;

    protected $table = 'cities';
    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function users()
    {
        return $this->hasMany(User::class, 'city_id');
    }

    public function developers()
    {
        return $this->belongsToMany(Developer::class, 'city_developers', 'city_id', 'developer_id')->withTimestamps();
    }

    public function complexes()
    {
        return $this->hasMany(Complex::class, 'city_id');
    }

    // SEO Methods
    protected function getDefaultSeoTitle()
    {
        return $this->name . ' - Проекты недвижимости и жилые комплексы';
    }

    protected function getDefaultSeoDescription()
    {
        $description = 'Проекты недвижимости и жилые комплексы в городе ' . $this->name . '.';
        $complexCount = $this->complexes()->count();
        if ($complexCount > 0) {
            $description .= ' Доступно ' . $complexCount . ' проектов.';
        }
        return $description;
    }

    protected function getDefaultSeoKeywords()
    {
        return $this->name . ', недвижимость, жилые проекты, комплексы, новостройки';
    }

    protected function getDefaultOgImage()
    {
        return null; // Для города нет изображения по умолчанию
    }

    protected function getDefaultCanonicalUrl()
    {
        return url('/complexes/all?city=' . $this->id); // URL страницы города
    }
}
