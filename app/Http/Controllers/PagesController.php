<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Complex;
use App\Models\Developer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class PagesController extends Controller
{
    // protected $city;

    public function __construct()
    {
        //
    }

    public function complexes(Request $request, $type, $filter = null)
    {
        $query = $request->query() ?? '';
        $user = Auth::user();
        if (!$user) {
            $selected_city_id = session('selected_city_id');
            $city = City::find($selected_city_id);
        } else {
            $city = $user->city;
        }
        // $search = $request->input('search') ?? '';
        try {
            $complexes = Complex::status()->filter($query)->where('city_id', $city->id)->where('type', $type)->orderBy('sort', 'desc')->paginate(10);
            // if (!$filter) {
            // $complexes = Complex::status()->where('city_id', $city->id)->where('type', $type)->where('name', 'like', '%' . $search . '%')->orderBy('sort', 'desc')->paginate(10);
            // } else {
            // }

            if ($request->header('HX-Request')) {
                return view('inc.complex_search_result', compact('complexes', 'type', 'query'));
            }

            return view('pages.complexes', compact('complexes', 'type', 'query'));
        } catch (\Exception $e) {
            return redirect('500');
        }
    }

    public function developers(Request $request, $filter = null)
    {
        $query = $request->query() ?? '';
        $user = Auth::user();
        if (!$user) {
            $selected_city_id = session('selected_city_id');
            $city = City::find($selected_city_id);
        } else {
            $city = $user->city;
        }
        try {
            // $search = $request->input('search') ?? '';
            if (!$filter) {
                $developers = $city->developers()->filter($query)->where('status', '1')->orderBy('sort', 'desc')->paginate(10);
            } else {
                $developers = $city->developers()->filter($query)->where('status', '1')->orderBy('sort', 'desc')->paginate(10);
            }

            if ($request->header('HX-Request')) {
                return view('inc.developer_search_result', compact('developers', 'query'));
            }

            return view('pages.developers', compact('developers', 'query'));
        } catch (\Exception $e) {
            return redirect('500');
        }
    }

    public function show_complex(Request $request, $slug)
    {
        $complex = Complex::status()->where('slug', $slug)->first();
        if (!$complex) {
            return to_route('500');
        }

        $user = Auth::user();
        if (!$user) {
            $selected_city_id = session('selected_city_id');
            $city = City::find($selected_city_id);
        } else {
            $city = $user->city;
        }

        $residential_complexes = Complex::status()
            ->where('developer_id', $complex->developer_id)
            ->where('type', 'residential')
            ->where('city_id', $city->id)
            ->where('slug', '!=', $complex->slug)
            ->limit(3)->orderBy('created_at', 'desc')
            ->get();

        $hotel_complexes = Complex::status()
            ->where('developer_id', $complex->developer_id)
            ->where('type', 'hotel')
            ->where('city_id', $city->id)
            ->where('slug', '!=', $complex->slug)
            ->limit(3)->orderBy('created_at', 'desc')
            ->get();

        return view('pages.show_complex', compact('complex', 'residential_complexes', 'hotel_complexes'));
    }

    public function show_developer(Request $request, $slug)
    {
        $developer = Developer::status()->where('slug', $slug)->first();
        if (!$developer) {
            return to_route('500');
        }

        $user = Auth::user();
        if (!$user) {
            $selected_city_id = session('selected_city_id');
            $city = City::find($selected_city_id);
        } else {
            $city = $user->city;
        }
        $complexes = $developer->complexes()->where('status', '1')->where('city_id', $city->id)->get();

        return view('pages.show_developer', compact('developer', 'complexes'));
    }

    public function complexes_by_developer(Request $request, $slug, $filter = null)
    {
        $query = $request->query() ?? '';

        $developer = Developer::status()->where('slug', $slug)->firts();
        if (!$developer) {
            return to_route('500');
        }
        try {
            $complex = $developer->complexes()->filter($query)->where('status', '1')->orderBy('sort', 'desc')->paginate(10);

            if ($request->header('HX-Request')) {
                return view('inc.complex_search_result', compact('complexes', 'residential', 'query'));
            }

            return view('pages.complexes', compact('complexes', 'residential', 'query'));
        } catch (\Exception $e) {
            return redirect('500');
        }
    }
}
