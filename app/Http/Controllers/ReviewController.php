<?php

namespace App\Http\Controllers;

use App\Facades\SEO;
use App\Models\City;
use App\Models\Review;
use App\Models\ReviewImage;
use App\Models\Developer;
use App\Models\Complex;
use App\Models\OfficialResponse;
use App\Models\ReviewComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Intervention\Image\Encoders\WebpEncoder;

class ReviewController extends Controller
{
    public function create(Request $request)
    {
        if (!Auth::check()) {
            return view('feedback');
        }

        $type = $request->get('type'); // 'developer' or 'complex'
        $id = $request->get('id');

        if ($type === 'developer') {
            $reviewable = Developer::findOrFail($id);
        } elseif ($type === 'complex') {
            $reviewable = Complex::findOrFail($id);
        } else {
            abort(404);
        }

        // Check if user already reviewed this item
        $existingReview = Review::where('user_id', Auth::id())
            ->where('reviewable_id', $id)
            ->where('reviewable_type', $type === 'developer' ? Developer::class : Complex::class)
            ->first();

        if ($existingReview) {
            return redirect()->back()->with([
                'type' => 'warning',
                'message' => 'Вы уже оставили отзыв для этого объекта. Каждый пользователь может оставить только один отзыв.'
            ]);
        }

        // Check daily limit (2 reviews per day)
        $todayReviewsCount = Review::where('user_id', Auth::id())
            ->whereDate('created_at', today())
            ->count();

        if ($todayReviewsCount >= 2) {
            return redirect()->back()->with([
                'type' => 'warning',
                'message' => 'Вы достигли дневного лимита отзывов (2 отзыва в день). Попробуйте завтра.'
            ]);
        }

        // SEO
        $objectType = $type === 'developer' ? 'застройщике' : 'ЖК';
        SEO::setTitle('Оставить отзыв о ' . $objectType . ' ' . $reviewable->name)
            ->setDescription('Поделитесь своим опытом о ' . $objectType . ' ' . $reviewable->name . '. Ваш отзыв поможет другим покупателям.')
            ->setKeywords('оставить отзыв, ' . $reviewable->name . ', ' . ($type === 'developer' ? 'застройщик' : 'жилой комплекс'))
            ->setCanonicalUrl(request()->url());

        return view('leavefeedback', compact('reviewable', 'type'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:developer,complex',
            'reviewable_id' => 'required|integer',
            'review_type' => 'required|in:positive,negative',
            'title' => 'required|string|max:255',
            'text' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'images.*' => 'nullable|image|max:10240' // max 10MB per image
        ]);

        // Get reviewable model
        if ($request->type === 'developer') {
            $reviewable = Developer::findOrFail($request->reviewable_id);
        } else {
            $reviewable = Complex::findOrFail($request->reviewable_id);
        }

        // Double check if user already reviewed this item
        $existingReview = Review::where('user_id', Auth::id())
            ->where('reviewable_id', $reviewable->id)
            ->where('reviewable_type', get_class($reviewable))
            ->first();

        if ($existingReview) {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'Вы уже оставили отзыв для этого объекта.'
            ]);
        }

        // Double check daily limit (2 reviews per day)
        $todayReviewsCount = Review::where('user_id', Auth::id())
            ->whereDate('created_at', today())
            ->count();

        if ($todayReviewsCount >= 2) {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'Вы достигли дневного лимита отзывов (2 отзыва в день).'
            ]);
        }

        // Filter bad words
        $title = Review::filterBadWords($request->title);
        $text = Review::filterBadWords($request->text);

        // Create review
        $review = Review::create([
            'user_id' => Auth::id(),
            'reviewable_id' => $reviewable->id,
            'reviewable_type' => get_class($reviewable),
            'type' => $request->review_type,
            'title' => $title,
            'text' => $text,
            'rating' => $request->rating,
            'city_id' => session('selected_city_id'),
            'is_approved' => 0, // 0: На модерации
        ]);

        // Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $this->uploadReviewImage($review, $image);
            }
        }

        return redirect()->route('review.show', $review)->with([
            'type' => 'success',
            'message' => 'Ваш отзыв отправлен на модерацию. Спасибо!'
        ]);
    }

    private function uploadReviewImage(Review $review, $image)
    {
        $imageName = time() . '_' . uniqid() . '.webp';

        if (!is_dir(storage_path('app/reviews'))) {
            mkdir(storage_path('app/reviews'), 0777, true);
        }

        $destinationPath = storage_path('app/reviews');
        $manager = new ImageManager(new Driver());
        $img = $manager->read($image);

        // Resize if too large
        if ($img->width() > 1200) {
            $img->resize(1200, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }

        // Save as WebP
        file_put_contents(
            $destinationPath . '/' . $imageName,
            (string) $img->encode(new \Intervention\Image\Encoders\WebpEncoder(quality: 85))
        );

        // Save to database
        ReviewImage::create([
            'review_id' => $review->id,
            'image_path' => $imageName
        ]);
    }

    public function show(Review $review)
    {
        // Reddedilen yorumları sadece yazan kullanıcı görebilir
        if ($review->is_approved == 1 && (!Auth::check() || Auth::id() !== $review->user_id)) {
            abort(404);
        }

        // Gizli yorumları sadece yazan kullanıcı görebilir
        if ($review->is_hidden && (!Auth::check() || Auth::id() !== $review->user_id)) {
            abort(404);
        }

        $review->incrementViews();
        $review->load(['user', 'reviewable', 'images']);

        // SEO
        $reviewableType = $review->reviewable_type === 'App\\Models\\Developer' ? 'застройщике' : 'ЖК';
        SEO::setTitle($review->title . ' - отзыв о ' . $reviewableType . ' ' . $review->reviewable->name)
            ->setDescription('Отзыв: ' . Str::limit(strip_tags($review->text), 150) . ' Рейтинг: ' . $review->rating . '/5')
            ->setKeywords('отзыв, ' . $review->reviewable->name . ', ' . ($review->reviewable_type === 'App\\Models\\Developer' ? 'застройщик' : 'жилой комплекс'))
            ->setCanonicalUrl(request()->url());

        return view('review.show', compact('review'));
    }

    public function like(Review $review)
    {
        if (!Auth::check()) {
            if (request()->ajax()) {
                return response()->json(['success' => false, 'message' => 'Необходимо войти в систему'], 401);
            }
            return redirect()->route('login');
        }

        // Check if review is approved and visible (0=модерация, 2=одобрен можно лайкать, 1=отклонен нельзя)
        if ($review->is_approved == 1 || $review->is_hidden) {
            if (request()->ajax()) {
                return response()->json(['success' => false, 'message' => 'Отзыв недоступен для оценки.'], 403);
            }
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'Отзыв недоступен для оценки.'
            ]);
        }

        $userId = Auth::id();

        // Check if user already liked/disliked this review
        $existingLike = \App\Models\ReviewLike::where('review_id', $review->id)
            ->where('user_id', $userId)
            ->first();

        $message = '';
        $userLikeStatus = null;

        if ($existingLike) {
            if ($existingLike->type === 'like') {
                // Remove like
                $existingLike->delete();
                $message = 'Лайк убран!';
                $userLikeStatus = null;
            } else {
                // Change dislike to like
                $existingLike->update(['type' => 'like']);
                $message = 'Спасибо за вашу оценку!';
                $userLikeStatus = 'like';
            }
        } else {
            // Add new like
            \App\Models\ReviewLike::create([
                'review_id' => $review->id,
                'user_id' => $userId,
                'type' => 'like'
            ]);
            $message = 'Спасибо за вашу оценку!';
            $userLikeStatus = 'like';
        }

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'userLikeStatus' => $userLikeStatus,
                'totalLikes' => $review->total_likes,
                'totalDislikes' => $review->total_dislikes
            ]);
        }

        return redirect()->back()->with([
            'type' => 'success',
            'message' => $message
        ]);
    }

    public function dislike(Review $review)
    {
        if (!Auth::check()) {
            if (request()->ajax()) {
                return response()->json(['success' => false, 'message' => 'Необходимо войти в систему'], 401);
            }
            return redirect()->route('login');
        }

        // Check if review is approved and visible (0=модерация, 2=одобрен можно лайкать, 1=отклонен нельзя)
        if ($review->is_approved == 1 || $review->is_hidden) {
            if (request()->ajax()) {
                return response()->json(['success' => false, 'message' => 'Отзыв недоступен для оценки.'], 403);
            }
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'Отзыв недоступен для оценки.'
            ]);
        }

        $userId = Auth::id();

        // Check if user already liked/disliked this review
        $existingLike = \App\Models\ReviewLike::where('review_id', $review->id)
            ->where('user_id', $userId)
            ->first();

        $message = '';
        $userLikeStatus = null;

        if ($existingLike) {
            if ($existingLike->type === 'dislike') {
                // Remove dislike
                $existingLike->delete();
                $message = 'Дизлайк убран!';
                $userLikeStatus = null;
            } else {
                // Change like to dislike
                $existingLike->update(['type' => 'dislike']);
                $message = 'Спасибо за вашу оценку!';
                $userLikeStatus = 'dislike';
            }
        } else {
            // Add new dislike
            \App\Models\ReviewLike::create([
                'review_id' => $review->id,
                'user_id' => $userId,
                'type' => 'dislike'
            ]);
            $message = 'Спасибо за вашу оценку!';
            $userLikeStatus = 'dislike';
        }

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'userLikeStatus' => $userLikeStatus,
                'totalLikes' => $review->total_likes,
                'totalDislikes' => $review->total_dislikes
            ]);
        }

        return redirect()->back()->with([
            'type' => 'success',
            'message' => $message
        ]);
    }

    public function officialResponse(Request $request, Review $review)
    {
        $text = Review::filterBadWords($request->text);

        $request->validate(rules: [
            'text' => 'required|string|max:10000',
            'images.*' => 'image|max:10240',
        ]);

        $official_response = OfficialResponse::create(attributes: [
            'review_id'     => $review->id,
            'user_id'       => Auth::id(),
            'text'          => $text,
        ]);

        if ($request->hasFile(key: 'images')) {
            if (!is_dir(filename: storage_path(path: 'app/reviews'))) {
                mkdir(directory: storage_path(path: 'app/reviews'), permissions: 0777, recursive: true);
            }

            $destinationPath = storage_path(path: 'app/reviews');
            $manager = new ImageManager(driver: new Driver());

            foreach ($request->file(key: 'images') as $idx => $image) {
                $name = time() . '_' . $idx . '.webp';
                $img = $manager->read(input: $image);

                file_put_contents(
                    filename: ($destinationPath . '/' . $name),
                    data: (string) $img->encode(encoder: new WebpEncoder(quality: 100))
                );

                $official_response->images()->create(attributes: ['image' => $name]);
            }
        }


        return redirect()->back();
    }

    public function storeComment(Request $request, Review $review)
    {
        $text = Review::filterBadWords($request->text);

        $comment = ReviewComment::create([
            'review_id' => $review->id,
            'user_id'   => Auth::id(),
            'text'      => $text,
        ]);

        return response()->json(['success' => true, 'html' => view('inc.review_comment_item', compact('comment'))->render()]);
    }

    public function allWeekly()
    {
        $user = Auth::user();
        if (!$user) {
            $selected_city_id = session('selected_city_id');
            $city = City::find($selected_city_id);
        } else {
            $city = $user->city;
        }
        $reviews = Review::whereIn('is_approved', [0, 2])
            ->where('is_hidden', false)
            ->where('city_id', $city->id)
            ->where('created_at', '>=', now()->subWeek())
            ->with(['user', 'reviewable', 'images'])
            ->withCount(['reviewLikes as user_likes_count'])
            ->orderByRaw('(likes + user_likes_count) DESC, views DESC')
            ->paginate(12);

        // SEO
        SEO::setTitle('Лучшие отзывы недели о застройщиках и ЖК в ' . $city->name)
            ->setDescription('Самые популярные и полезные отзывы недели о застройщиках и жилых комплексах в городе ' . $city->name)
            ->setKeywords('лучшие отзывы, отзывы недели, застройщики ' . $city->name . ', жилые комплексы')
            ->setCanonicalUrl(request()->url());

        return view('pages.all_reviews-weekly', compact('reviews'));
    }

    public function allReviewByDeveloper(Developer $developer)
    {
        $reviews = Review::where('reviewable_type', Developer::class)
            ->where('reviewable_id', $developer->id)
            ->whereIn('is_approved', [0, 2])
            ->where('is_hidden', false)
            ->with(['user', 'images'])
            ->orderByDesc('created_at')
            ->paginate(12);
        $type = 'Developer';

        // SEO
        SEO::setTitle('Все отзывы о застройщике ' . $developer->name)
            ->setDescription('Читайте все отзывы покупателей о застройщике ' . $developer->name . '. Честные мнения и опыт сотрудничества.')
            ->setKeywords('отзывы ' . $developer->name . ', застройщик, отзывы покупателей, недвижимость')
            ->setCanonicalUrl(request()->url());

        return view('pages.all_reviews-by-developer', compact('type', 'developer', 'reviews'));
    }

    public function allReviewByComplex(Complex $complex)
    {
        $reviews = Review::where('reviewable_type', Complex::class)
            ->where('reviewable_id', $complex->id)
            ->whereIn('is_approved', [0, 2])
            ->where('is_hidden', false)
            ->with(['user', 'images'])
            ->orderByDesc('created_at')
            ->paginate(12);
        $type = 'Complex';

        // SEO
        SEO::setTitle('Все отзывы о ЖК ' . $complex->name)
            ->setDescription('Читайте все отзывы покупателей о жилом комплексе ' . $complex->name . '. Честные мнения и опыт покупки недвижимости.')
            ->setKeywords('отзывы ' . $complex->name . ', ЖК, отзывы покупателей, недвижимость')
            ->setCanonicalUrl(request()->url());

        return view('pages.all_reviews-by-developer', compact('type', 'complex', 'reviews'));
    }
}
