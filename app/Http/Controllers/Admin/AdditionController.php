<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Addition;
use App\Models\Review;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdditionController extends Controller
{
    public function additions($reviewId): View
    {
        $review = Review::with(relations: ['user', 'reviewable', 'additions.images', 'additions.user'])
            ->findOrFail(id: $reviewId);

        return view(view: 'admin.review.additions', data: compact(var_name: 'review'));
    }

    public function approveAddition($additionId): RedirectResponse
    {
        $addition = Addition::findOrFail(id: $additionId);
        $addition->is_approved = true;
        // $addition->is_hidden = false;
        $addition->save();

        return back()->with(key: ['type' => 'success', 'message' => 'Дополнение одобрено']);
    }

    public function rejectAddition($additionId): RedirectResponse
    {
        $addition = Addition::findOrFail(id: $additionId);
        $addition->is_approved = false;
        // $addition->is_hidden = true;
        $addition->save();

        return back()->with(key: ['type' => 'success', 'message' => 'Дополнение скрыто']);
    }
}
