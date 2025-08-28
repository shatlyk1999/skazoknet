<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Exception;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $query = Review::with(['user', 'reviewable', 'city']);

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('text', 'like', '%' . $request->search . '%')
                    ->orWhereHas('user', function ($userQuery) use ($request) {
                        $userQuery->where('name', 'like', '%' . $request->search . '%');
                    });
            });
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('is_approved')) {
            $query->where('is_approved', $request->is_approved);
        }

        if ($request->filled('include_in_rating')) {
            $query->where('include_in_rating', $request->include_in_rating);
        }

        if ($request->filled('reviewable_type')) {
            $query->where('reviewable_type', 'App\\Models\\' . ucfirst($request->reviewable_type));
        }

        if ($request->filled('is_hidden')) {
            $query->where('is_hidden', $request->is_hidden);
        }

        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        $reviews = $query->orderByDesc('id')->paginate(10);
        $cities = \App\Models\City::all();

        return view('admin.review.index', compact('reviews', 'cities'));
    }



    public function update(Request $request, Review $review)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string',
            'admin_note' => 'nullable|string',
            'likes' => 'nullable|integer|min:0',
            'dislikes' => 'nullable|integer|min:0'
        ]);

        try {
            $review->update([
                'title' => $request->title,
                'text' => $request->text,
                'admin_note' => $request->admin_note,
                'likes' => $request->likes ?? 0,
                'dislikes' => $request->dislikes ?? 0,
            ]);

            return redirect()->back()->with([
                'type' => 'success',
                'message' => 'Отзыв успешно обновлен',
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function approve(Review $review)
    {
        try {
            $review->update(['is_approved' => true]);

            return redirect()->back()->with([
                'type' => 'success',
                'message' => 'Отзыв одобрен',
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function reject(Review $review)
    {
        try {
            $review->update(['is_approved' => false]);

            return redirect()->back()->with([
                'type' => 'success',
                'message' => 'Отзыв отклонен',
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function toggleRating(Review $review)
    {
        try {
            $review->update(['include_in_rating' => !$review->include_in_rating]);

            $message = $review->include_in_rating ?
                'Отзыв включен в рейтинг' :
                'Отзыв исключен из рейтинга';

            return redirect()->back()->with([
                'type' => 'success',
                'message' => $message,
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function hide(Review $review)
    {
        try {
            $review->update(['is_hidden' => true]);

            return redirect()->back()->with([
                'type' => 'success',
                'message' => 'Отзыв скрыт. Теперь его видит только автор.',
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function unhide(Review $review)
    {
        try {
            $review->update(['is_hidden' => false]);

            return redirect()->back()->with([
                'type' => 'success',
                'message' => 'Отзыв снова видим всем пользователям.',
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function destroy(Review $review)
    {
        try {
            // Delete images from storage
            foreach ($review->images as $image) {
                $imagePath = storage_path('app/reviews/' . $image->image_path);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $review->delete();

            return redirect()->back()->with([
                'type' => 'success',
                'message' => 'Отзыв успешно удален',
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }
}
