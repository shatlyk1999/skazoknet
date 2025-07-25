<?php

namespace App\Providers;

use App\Services\SeoService;
use Illuminate\Support\ServiceProvider;

class SeoServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('seo', function () {
            return new SeoService();
        });
    }

    public function boot()
    {
        //
    }
}
