<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingsControlller;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\AdminMiddleware;
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
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Письмо с подтверждением было отправлено повторно.');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('mail-confirmed', function () {
        return view('mail.confirmed_mail');
    });
});



Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('registration', function () {
    return view('auth.registration');
})->name('registration');
Route::get('send-email-register-verify', function () {
    return view('mail.register_mail');
});
Route::get('about-us', [HomeController::class, 'about_us'])->name('about_us');

//auth
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return 'this verified';
    });
});




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
    Route::post('user-status', [UserController::class, 'updateStatus']);
    Route::post('user-permission-comment', [UserController::class, 'updatePermissionComment']);
    Route::get('settings/about-us', [SettingsControlller::class, 'about_us'])->name('settings.about_us');
    Route::post('settings/about-us', [SettingsControlller::class, 'about_us_store'])->name('settings.about_us.store');
});

Route::get('404', function () {
    return response()->view('layouts.404', [], 404);
});
Route::fallback(function () {
    return response()->view('layouts.404', [], 404);
});

Route::get('send-test-mail', [EmailController::class, 'sendEmail']);
