<?php

namespace App\Http\Middleware;

use App\Models\City;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class CityMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $city = null;

        if (Auth::check()) {
            $user = Auth::user();
            $city = $user->city ?? City::where('name', 'Краснодар')->first();

            // Если у пользователя нет city_id, назначаем и сохраняем
            if (!$user->city_id && $city) {
                $user->city_id = $city->id;
                $user->save();
            }
        } elseif (session()->has('selected_city_id')) {
            $city = City::find(session('selected_city_id'));
        } else {
            $city = City::where('name', 'Краснодар')->first();
            if ($city) {
                session(['selected_city_id' => $city->id]);
            }
        }

        // Передаем переменную $city в представления
        if ($city) {
            View::share('city', $city);
        }

        return $next($request);
    }
}
