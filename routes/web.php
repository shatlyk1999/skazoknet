<?php

use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\ComplexController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DeveloperController;
use App\Http\Controllers\Admin\SettingsControlller;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PagesController;
use App\Http\Middleware\AdminMiddleware;
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
    Route::get('index-cities', [HomeController::class, 'cities']);
    Route::post('update-city', [HomeController::class, 'update_city']);
    Route::get('complexes/{type}', [PagesController::class, 'complexes'])->name('complexes');
    Route::get('developers', [PagesController::class, 'developers'])->name('developers');
    Route::get('complex/{slug}', [PagesController::class, 'show_complex'])->name('show.complex');
    Route::get('developer/{slug}', [PagesController::class, 'show_developer'])->name('show.developer');
    Route::get('complexes/by/{developer}', [PagesController::class, 'complexes_by_developer'])->name('complexes.by.developer');
});

//auth
// Route::middleware(['auth'])->group(function () {
//     Route::get('/dashboard', function () {
//         return 'this verified';
//     });
// });




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
});

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
