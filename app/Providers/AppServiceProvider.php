<?php

namespace App\Providers;

use App\Models\City;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('seo', function ($app) {
            return new \App\Services\SeoService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Paginator::useBootstrapFive();
        if (request()->is('admin/*')) {
            Paginator::useBootstrapFive();
        }

        // $user = Auth::user();

        // if (!$user) {
        //     $selected_city_id = session('selected_city_id');
        //     if (!$selected_city_id) {
        //         $city = City::where('name', 'Краснодар')->first();
        //         if ($city) {
        //             $selected_city_id = $city->id;
        //             session(['selected_city_id' => $selected_city_id]);
        //         }
        //     } else {
        //         $city = City::find($selected_city_id);
        //     }
        // } else {
        //     if ($user->city_id == null) {
        //         $city = City::where('name', 'Краснодар')->first();
        //         if (!$city) {
        //             return;
        //         }
        //         $user->city_id = $city->id;
        //         $user->save();
        //     } else {
        //         $city = $user->city;
        //         if (!$city) {
        //             $city = City::where('name', 'Краснодар')->first();
        //             $user->city_id = $city->id;
        //             $user->save();
        //         }
        //     }
        // }
        // view()->composer(['layouts.header', 'index.head_background'], function ($view) use ($city) {
        //     $view->with('city', $city);
        // });
    }
}
