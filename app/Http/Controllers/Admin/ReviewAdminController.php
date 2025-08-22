<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Review::with(['user', 'complex', 'additions']);

        if ($request->filled('is_approved')) {
            $query->where('is_approved', (bool)$request->is_approved);
        }
        if ($request->filled('has_additions')) {
            if ($request->has_additions === '1') {
                $query->has('additions');
            } elseif ($request->has_additions === '0') {
                $query->doesntHave('additions');
            }
        }
        if ($request->filled('pending_additions') && $request->pending_additions === '1') {
            $query->whereHas('additions', function ($q) {
                $q->where('is_approved', false);
            });
        }

        $reviews = $query->orderByDesc('created_at')->paginate(15)->withQueryString();
        $pendingCount = Review::where('is_approved', false)->count();
        $pendingAdditionsCount = \App\Models\ReviewAddition::where('is_approved', false)->count();

        return view('admin/review/index', compact('reviews', 'pendingCount', 'pendingAdditionsCount'));
    }
}