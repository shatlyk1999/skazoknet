<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Illuminate\Http\Request;

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
        return view('home', compact('index_page'));
    }

    public function about_us()
    {
        $data = AboutUs::first() ?? null;
        return view('common.about_us', compact('data'));
    }
}
