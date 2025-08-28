<?php

namespace App\Http\Controllers;

use App\Facades\SEO;
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
            // ->limit(3)
            ->orderBy('created_at', 'desc')
            ->get();

        $hotel_complexes = Complex::status()
            ->where('developer_id', $complex->developer_id)
            ->where('type', 'hotel')
            ->where('city_id', $city->id)
            ->where('slug', '!=', $complex->slug)
            // ->limit(3)
            ->orderBy('created_at', 'desc')
            ->get();

        // Get approved reviews for this complex
        $reviews = $complex->reviews()
            ->where('is_approved', true)
            ->where('is_hidden', false)
            ->with(['user', 'images'])
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        // Calculate average rating using our custom attribute
        $averageRating = $complex->average_rating;

        $totalReviews = $complex->reviews()
            ->where('is_approved', true)
            ->count();

        // SEO 
        SEO::setTitle($complex->getSeoTitle())
            ->setDescription($complex->getSeoDescription())
            ->setKeywords($complex->getSeoKeywords())
            ->setOgImage($complex->getOgImage())
            ->setCanonicalUrl($complex->getCanonicalUrl())
            ->addSchemaMarkup('RealEstateAgent', [
                'name' => $complex->name,
                'description' => $complex->getSeoDescription(),
                'address' => [
                    '@type' => 'PostalAddress',
                    'streetAddress' => $complex->address,
                    'addressLocality' => $complex->city?->name,
                    'addressCountry' => 'RU'
                ],
                'geo' => $complex->map_x && $complex->map_y ? [
                    '@type' => 'GeoCoordinates',
                    'latitude' => $complex->map_y,
                    'longitude' => $complex->map_x
                ] : null
            ]);

        return view('pages.show_complex', compact('complex', 'residential_complexes', 'hotel_complexes', 'reviews', 'averageRating', 'totalReviews'));
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

        // Get approved reviews for this developer
        $reviews = $developer->reviews()
            ->where('is_approved', true)
            ->where('is_hidden', false)
            ->with(['user', 'images'])
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        // Calculate average rating using our custom attribute
        $averageRating = $developer->average_rating;

        $totalReviews = $developer->reviews()
            ->where('is_approved', true)
            ->count();

        // SEO
        SEO::setTitle($developer->getSeoTitle())
            ->setDescription($developer->getSeoDescription())
            ->setKeywords($developer->getSeoKeywords())
            ->setOgImage($developer->getOgImage())
            ->setCanonicalUrl($developer->getCanonicalUrl())
            ->addSchemaMarkup('Organization', [
                'name' => $developer->name,
                'description' => $developer->getSeoDescription(),
                'foundingDate' => $developer->year_establishment,
                'url' => $developer->getCanonicalUrl()
            ]);

        return view('pages.show_developer', compact('developer', 'complexes', 'reviews', 'averageRating', 'totalReviews'));
    }

    public function complexes_by_developer(Request $request, $slug, $filter = null)
    {
        $query = $request->query() ?? '';

        $developer = Developer::status()->where('slug', $slug)->first();
        if (!$developer) {
            return to_route('500');
        }
        try {
            $complexes = $developer->complexes()->filter($query)->where('status', '1')->orderBy('sort', 'desc')->paginate(10);

            if ($request->header('HX-Request')) {
                return view('inc.complex_search_result', compact('complexes', 'residential', 'query'));
            }

            return view('pages.complexes', compact('complexes', 'residential', 'query'));
        } catch (\Exception $e) {
            return redirect('500');
        }
    }
}
