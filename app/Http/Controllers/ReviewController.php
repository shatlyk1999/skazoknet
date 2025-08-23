<?php

namespace App\Http\Controllers;

use App\Models\Complex;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function create(Request $request)
    {
        // Demo data: get latest review of user or a placeholder
        $review = Review::with(['complex'])
            ->where('user_id', auth()->id())
            ->latest()
            ->first();

        // Fallback placeholders for view when review is null
        return view('cabinet.addition-create', [
            'review' => $review,
        ]);
    }
}

