<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReviewComment;
use Illuminate\Http\Request;

class ReviewCommentController extends Controller
{
    public function index(Request $request)
    {
        $q = ReviewComment::with(['review', 'user']);

        if ($request->filled('review_id')) {
            $q->where('review_id', $request->review_id);
        }

        $comments = $q->orderByDesc('created_at')->paginate(10)->withQueryString();

        return view('admin/review/comments', compact('comments'));
    }

    public function show($id)
    {
        $c = ReviewComment::with(['review', 'user'])->findOrFail($id);
        return response()->json([
            'id'         => $c->id,
            'review_id'  => $c->review_id,
            'user'       => $c->user?->name,
            'text'       => $c->text,
            'created_at' => $c->created_at->toDateTimeString(),
        ]);
    }
}
