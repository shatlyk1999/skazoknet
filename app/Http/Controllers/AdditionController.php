<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Addition;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
// use App\Models\AdditionImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;

class AdditionController extends Controller
{
    public function __construct()
    {
        $this->middleware(middleware: 'auth');
    }

    public function myReviews(): View
    {
        $reviews = Review::where(column: 'user_id', operator: Auth::id())
            ->withCount(relations: ['additions' => function ($q): void {
                $q->where('is_hidden', false);
            }])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view(view: 'cabinet.my-reviews', data: compact(var_name: 'reviews'));
    }

    public function createAddition($reviewId): View
    {
        $review = Review::where(column: 'id', operator: $reviewId)
            ->where(column: 'user_id', operator: Auth::id())
            ->firstOrFail();

        return view(view: 'review.addition-create', data: compact(var_name: 'review'));
    }

    public function storeAddition(Request $request, $reviewId): RedirectResponse
    {
        $review = Review::where(column: 'id', operator: $reviewId)
            ->where(column: 'user_id', operator: Auth::id())
            ->firstOrFail();

        $text = Addition::filterBadWords($request->text);

        $request->validate(rules: [
            'text' => 'required|string|max:10000',
            'images.*' => 'image|max:10240',
        ]);

        $addition = Addition::create(attributes: [
            'review_id'     => $review->id,
            'user_id'       => Auth::id(),
            'text'          => $text,
            'is_approved'   => false,
        ]);

        if ($request->hasFile(key: 'images')) {
            if (!is_dir(filename: storage_path(path: 'app/addition-images'))) {
                mkdir(directory: storage_path(path: 'app/addition-images'), permissions: 0777, recursive: true);
            }

            $destinationPath = storage_path(path: 'app/addition-images');
            $manager = new ImageManager(driver: new Driver());

            foreach ($request->file(key: 'images') as $idx => $image) {
                $name = time() . '_' . $idx . '.webp';
                $img = $manager->read(input: $image);

                file_put_contents(
                    filename: ($destinationPath . '/' . $name),
                    data: (string) $img->encode(encoder: new WebpEncoder(quality: 100))
                );

                $addition->images()->create(attributes: ['image' => $name]);
            }
        }


        return redirect()->route('myReviews', Auth::id())->with(key: [
            'type' => 'success',
            'message' => 'Дополнение отправлено на модерацию',
        ]);
    }
}
