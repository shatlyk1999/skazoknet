<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $index_page = true;

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
        //         $user->city_id = $city->id;
        //         $user->save();
        //     } else {
        //         $city = $user->city;
        //         $city = City::find($city->id);
        //         if (!$city) {
        //             $city = City::where('name', 'Краснодар')->first();
        //             $user->city_id = $city->id;
        //             $user->save();
        //         }
        //     }
        // }
        return view('home', compact('index_page'));
    }

    public function about_us()
    {
        $data = AboutUs::first() ?? null;
        return view('common.about_us', compact('data'));
    }

    public function cities()
    {
        $cities =  City::orderBy('id', 'asc')->get();
        return response()->json($cities);
    }

    public function update_city(Request $request)
    {
        if ($request->has('id')) {
            $city = City::find($request->id);
            if ($city) {
                $user = Auth::user();
                if (!$user) {
                    session(['selected_city_id' => $city->id]);
                } else {
                    $user->city_id = $city->id;
                    $user->save();
                }

                return response()->json([
                    'message' => 'successfully updated city',
                ], 200);
            }
        }

        return response()->json([
            'error' => 'city id not found'
        ], 400);
    }
}
