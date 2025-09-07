<?php

use App\Http\Controllers\AccessController;
use App\Http\Controllers\AdditionController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\ComplexController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DeveloperController;
use App\Http\Controllers\Admin\ReviewCommentController;
use App\Http\Controllers\Admin\SettingsControlller;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\CityMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

Auth::routes();
/**
 * 1. Doğrulama bekleme ekranı (kayıt olduktan sonra yönlendirilir)
 */
// Route::get('/email/verify', function () {
//     return view('auth.verify-email'); // bu view’i birazdan oluşturacağız
// })->middleware('auth')->name('verification.notice');

/**
 * 2. Maildeki linke tıklanınca tetiklenir
 */
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill(); // Kullanıcının email_verified_at sütununu doldurur
    return view('mail.confirmed_mail'); // İstediğin sayfaya yönlendirebilirsin
})->middleware(['auth', 'signed'])->name('verification.verify');

/**
 * 3. "Tekrar gönder" butonuna basıldığında tetiklenir
 */
// Route::post('/email/verification-notification', function (Request $request) {
//     $request->user()->sendEmailVerificationNotification();
//     return back()->with('message', 'Письмо с подтверждением было отправлено повторно.');
// })->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('mail-confirmed', function () {
        return view('mail.confirmed_mail');
    });
});
Route::get('recovery-confirmed', function () {
    return view('mail.confirmed_mail');
});


Route::group(['middleware' => CityMiddleware::class], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('registration', function () {
        return view('auth.registration');
    })->name('registration');
    Route::get('send-email-register-verify', function () {
        return view('mail.register_mail');
    });
    Route::get('about-us', [HomeController::class, 'about_us'])->name('about_us');
    Route::get('contact', [ContactController::class, 'index'])->name('contact.index');
    // Route::get('contact-completed', [ContactController::class, 'index'])->name('contact.completed');
    Route::post('contact', [ContactController::class, 'store'])->name('contact.store');
    Route::get('index-cities', [HomeController::class, 'cities']);
    Route::post('update-city', [HomeController::class, 'update_city']);
    Route::get('complexes/{type}', [PagesController::class, 'complexes'])->name('complexes');
    Route::get('developers', [PagesController::class, 'developers'])->name('developers');
    Route::get('complex/{slug}', [PagesController::class, 'show_complex'])->name('show.complex');
    Route::get('developer/{slug}', [PagesController::class, 'show_developer'])->name('show.developer');
    Route::get('complexes/by/{developer}', [PagesController::class, 'complexes_by_developer'])->name('complexes.by.developer');

    // Review routes
    Route::get('review/{review}/show', [ReviewController::class, 'show'])->name('review.show');
    Route::get('review/create', [ReviewController::class, 'create'])->name('review.create');
    Route::get('all-reviews-weekly', [ReviewController::class, 'allWeekly'])->name('allWeekly');
    Route::get('all-reviews-by-developer/{developer}', [ReviewController::class, 'allReviewByDeveloper'])->name('allReviewByDeveloper');
    Route::get('all-reviews-by-complex/{complex}', [ReviewController::class, 'allReviewByComplex'])->name('allReviewByComplex');
    Route::group(['middleware' => AuthMiddleware::class], function () {
        Route::post('review/store', [ReviewController::class, 'store'])->name('review.store');
        Route::post('review/{review}/like', [ReviewController::class, 'like'])->name('review.like');
        Route::post('review/{review}/dislike', [ReviewController::class, 'dislike'])->name('review.dislike');
        Route::post('review/{review}/official-response', [ReviewController::class, 'officialResponse'])->name('post.official_response');
        Route::post('reviews/{review}/comments', [ReviewController::class, 'storeComment'])->name('reviews.comments.store');
        // Route::get('my-reviews', [AdditionController::class, 'myReviews'])->name('myReviews');
        Route::get('reviews/{review}/additions/create', [AdditionController::class, 'createAddition'])->name('reviews.additions.create');
        Route::post('reviews/{review}/additions', [AdditionController::class, 'storeAddition'])->name('reviews.additions.store');
        Route::get('user-profile/{id}', [ProfileController::class, 'userProfile'])->name('userProfile');
        Route::get('developer-profile/{id}', [ProfileController::class, 'developerProfile'])->name('developerProfile');
        Route::post('user-update/{id}', [ProfileController::class, 'userUpdate'])->name('userUpdate');
        Route::get('about-company/{id}', [ProfileController::class, 'aboutCompany'])->name('aboutCompany');
        Route::put('about-company/{id}', [ProfileController::class, 'updateCompany'])->name('updateCompany');

        // Review routes
        Route::get('my-reviews/{id}', [ProfileController::class, 'myReviews'])->name('myReviews');
        Route::get('all-reviews/{id}', [ProfileController::class, 'allReviews'])->name('allReviews');

        // Complex routes
        Route::get('my-complexes/{id}', [ProfileController::class, 'myComplexes'])->name('myComplexes');
        Route::get('search-complexes/{id}', [ProfileController::class, 'searchComplexes'])->name('searchComplexes');
        Route::get('create-complex/{id}', [ProfileController::class, 'createComplex'])->name('createComplex');
        Route::post('create-complex/{id}', [ProfileController::class, 'storeComplex'])->name('storeComplex');
        Route::get('edit-complex/{userId}/{complexId}', [ProfileController::class, 'editComplex'])->name('editComplex');
        Route::put('edit-complex/{userId}/{complexId}', [ProfileController::class, 'updateComplex'])->name('updateComplex');
        Route::delete('complex-image/{imageId}', [ProfileController::class, 'deleteComplexImage'])->name('deleteComplexImage');
        // Reviews: addition create (static view)
        Route::get('addition-create', function () {
            return view('cabinet.addition-create');
        })->name('addition.create');
    });
    Route::get('gaining-access', [AccessController::class, 'index'])->name('gainingaccess');
    Route::post('access-post', [AccessController::class, 'store'])->name('access.post');
});

//auth
// Route::middleware(['auth'])->group(function () {
//     Route::get('/dashboard', function () {
//         return 'this verified';
//     });
// });


Route::get('404', function () {
    return response()->view('errors.404', [], 404);
});
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
Route::get('403', function () {
    return response()->view('errors.403', [], 403);
});
Route::get('500', function () {
    return response()->view('errors.500', [], 500);
});

Route::get('send-test-mail', [EmailController::class, 'sendEmail']);

// SEO sitemap
Route::get('sitemap.xml', [App\Http\Controllers\SitemapController::class, 'index']);



//backend/adm/login
Route::get('backend/adm/login', function () {
    return view('admin.auth.login');
});

Route::group([
    'prefix' => 'backend/adm',
    'middleware' => AdminMiddleware::class,
], function () {
    Route::get('', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('city', CityController::class);
    Route::resource('developer', DeveloperController::class);
    Route::resource('complex', ComplexController::class);
    Route::post('user-status', [UserController::class, 'updateStatus']);
    Route::post('user-permission-comment', [UserController::class, 'updatePermissionComment']);
    Route::post('developer-status', [DeveloperController::class, 'updateStatus']);
    Route::post('complex-status', [ComplexController::class, 'updateStatus']);
    Route::get('complex-image/{image_id}', [ComplexController::class, 'destroyComplexImage'])->name('complex-image');
    Route::get('settings/about-us', [SettingsControlller::class, 'about_us'])->name('settings.about_us');
    Route::post('settings/about-us', [SettingsControlller::class, 'about_us_store'])->name('settings.about_us.store');
    Route::post('developer-filter', [DeveloperController::class, 'index'])->name('developer.index.post');
    Route::post('complex-filter', [ComplexController::class, 'index'])->name('complex.index.post');

    // Access Management (Заявки)
    Route::get('access', [App\Http\Controllers\Admin\AccessController::class, 'index'])->name('admin.access.index');
    Route::get('access/{id}/reject', [App\Http\Controllers\Admin\AccessController::class, 'reject'])->name('admin.access.reject');
    Route::post('access/{id}/reject', [App\Http\Controllers\Admin\AccessController::class, 'sendRejectMessage'])->name('admin.access.sendReject');
    Route::get('access/{id}/approve', [App\Http\Controllers\Admin\AccessController::class, 'approve'])->name('admin.access.approve');
    Route::post('access/{id}/approve', [App\Http\Controllers\Admin\AccessController::class, 'sendApproveMessage'])->name('admin.access.sendApprove');

    // SEO Management
    Route::resource('seo', App\Http\Controllers\Admin\SeoController::class)->names('admin.seo');

    // Bad Words Management
    Route::resource('bad-word', App\Http\Controllers\Admin\BadWordController::class);

    // Reviews Management
    Route::resource('reviews', App\Http\Controllers\Admin\ReviewController::class)->only(['index', 'update', 'destroy']);
    Route::post('reviews/{review}/approve', [App\Http\Controllers\Admin\ReviewController::class, 'approve'])->name('reviews.approve');
    Route::post('reviews/{review}/reject', [App\Http\Controllers\Admin\ReviewController::class, 'reject'])->name('reviews.reject');
    Route::post('reviews/{review}/toggle-rating', [App\Http\Controllers\Admin\ReviewController::class, 'toggleRating'])->name('reviews.toggle-rating');
    Route::post('reviews/{review}/hide', [App\Http\Controllers\Admin\ReviewController::class, 'hide'])->name('reviews.hide');
    Route::post('reviews/{review}/unhide', [App\Http\Controllers\Admin\ReviewController::class, 'unhide'])->name('reviews.unhide');
    Route::get('review/{id}/additions', [\App\Http\Controllers\Admin\AdditionController::class, 'additions'])->name('admin.review.additions');
    Route::post('review/additions/{addition}/approve', [\App\Http\Controllers\Admin\AdditionController::class, 'approveAddition'])->name('admin.review.additions.approve');
    Route::post('review/additions/{addition}/reject', [\App\Http\Controllers\Admin\AdditionController::class, 'rejectAddition'])->name('admin.review.additions.reject');
    Route::get('review-comments', [ReviewCommentController::class, 'index'])->name('admin.review_comments.index');
    Route::get('review-comments/{id}', [ReviewCommentController::class, 'show'])->name('admin.review_comments.show');

    Route::get('contact', [\App\Http\Controllers\Admin\ContactController::class, 'index'])->name('admin.contact.index');
});
