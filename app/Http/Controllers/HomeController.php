<?php

namespace App\Http\Controllers;

use App\Facades\SEO;
use App\Models\AboutUs;
use App\Models\City;
use App\Models\Complex;
use App\Models\Developer;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    // protected $city;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            $selected_city_id = session('selected_city_id');
            $city = City::find($selected_city_id);
        } else {
            $city = $user->city;
        }

        $index_page = true;

        // Guard: if no city is available at all, return safe empty datasets
        if (!$city) {
            $complexes_residential = collect();
            $complexes_hotel = collect();
            $residential_count = 0;
            $hotel_count = 0;
            $developers = collect();
            $count_developers = 0;
            $reviews = collect();

            return view('home', compact(
                'index_page',
                'city',
                'complexes_residential',
                'complexes_hotel',
                'residential_count',
                'hotel_count',
                'developers',
                'reviews',
                'count_developers',
            ));
        }

        $complexes_residential = Complex::status()->where('city_id', $city->id)->where('type', 'residential')->orderBy('sort', 'desc')->limit(6)->get();
        $complexes_hotel = Complex::status()->where('city_id', $city->id)->where('type', 'hotel')->orderBy('sort', 'desc')->limit(6)->get();
        $residential_count = Complex::status()->where('city_id', $city->id)->where('type', 'residential')->count();
        $hotel_count = Complex::status()->where('city_id', $city->id)->where('type', 'hotel')->count();
        $developers = $city->developers()->where('status', '1')->orderBy('sort', 'desc')->limit(6)->get();
        $count_developers = $city->developers()->where('status', '1')->count();

        // Get best reviews of the week - sorted by likes first, then views, filtered by city
        $reviews = Review::whereIn('is_approved', [0, 2])
            ->where('is_hidden', false)
            ->where('city_id', $city->id)
            ->where('created_at', '>=', now()->subWeek())
            ->with(['user', 'reviewable', 'images'])
            ->withCount(['reviewLikes as user_likes_count'])
            ->orderByRaw('(likes + user_likes_count) DESC, views DESC')
            ->limit(6)
            ->get();

        // SEO
        SEO::setTitle('Сказокнет - отзывы без иллюзий о застройщиках и ЖК в ' . $city->name)
            ->setDescription('Честные отзывы о застройщиках и жилых комплексах в городе ' . $city->name . '. Читайте реальные мнения покупателей недвижимости.')
            ->setKeywords('отзывы застройщики, жилые комплексы, недвижимость ' . $city->name . ', отзывы покупателей')
            ->setCanonicalUrl(request()->url());

        return view('home', compact(
            'index_page',
            'city',
            'complexes_residential',
            'complexes_hotel',
            'residential_count',
            'hotel_count',
            'developers',
            'reviews',
            'count_developers',
        ));
    }

    public function about_us()
    {
        $data = AboutUs::first() ?? null;

        // SEO
        SEO::setTitle('О проекте Сказокнет - честные отзывы о недвижимости')
            ->setDescription('Узнайте больше о проекте Сказокнет - платформе для честных отзывов о застройщиках и жилых комплексах.')
            ->setKeywords('о проекте, сказокнет, отзывы недвижимость, о нас')
            ->setCanonicalUrl(request()->url());

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
                    session()->put('selected_city_id', $city->id);
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
