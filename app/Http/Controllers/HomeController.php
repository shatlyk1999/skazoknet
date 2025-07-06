<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\City;
use App\Models\Complex;
use App\Models\Developer;
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

        $user = Auth::user();
        if (!$user) {
            $selected_city_id = session('selected_city_id');
            $city = City::find($selected_city_id);
        } else {
            $city = $user->city;
        }

        $complexes = Complex::status()->where('city_id', $city->id)->orderBy('sort', 'desc')->limit(6)->get();
        $residential_count = Complex::status()->where('city_id', $city->id)->where('type', 'residential')->count();
        $hotel_count = Complex::status()->where('city_id', $city->id)->where('type', 'hotel')->count();
        $developers = $city->developers()->status()->orderBy('sort', 'desc')->limit(6)->get();

        return view('home', compact(
            'index_page',
            'city',
            'complexes',
            'residential_count',
            'hotel_count',
            'developers',
        ));
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
