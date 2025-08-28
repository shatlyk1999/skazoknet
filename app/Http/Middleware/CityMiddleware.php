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

        // Helper: resolve a safe fallback city ("Краснодар" if exists, otherwise the first city)
        $resolveFallbackCity = function () {
            return City::where('name', 'Краснодар')->first() ?? City::orderBy('id', 'asc')->first();
        };

        if (Auth::check()) {
            $user = Auth::user();
            $city = $user->city ?? $resolveFallbackCity();

            // Если у пользователя нет city_id, назначаем и сохраняем
            if (!$user->city_id && $city) {
                $user->city_id = $city->id;
                $user->save();
            }
        } elseif (session()->has('selected_city_id')) {
            // Try to use session city; if invalid, reset to a fallback
            $city = City::find(session('selected_city_id'));
            if (!$city) {
                session()->forget('selected_city_id');
                $city = $resolveFallbackCity();
                if ($city) {
                    session(['selected_city_id' => $city->id]);
                }
            }
        } else {
            // No session — pick a fallback and set it into session if available
            $city = $resolveFallbackCity();
            if ($city) {
                session(['selected_city_id' => $city->id]);
            }
        }

        // Передаем переменную $city в представления (если найден город)
        if ($city) {
            View::share('city', $city);
        }

        return $next($request);
    }
}