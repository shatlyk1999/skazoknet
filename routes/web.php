<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ADmin\UserController;
use App\Http\Controllers\EmailController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

Auth::routes();
Route::get('registration', function () {
    return view('auth.registration');
})->name('registration');

/**
 * 1. Doğrulama bekleme ekranı (kayıt olduktan sonra yönlendirilir)
 */
Route::get('/email/verify', function () {
    return view('auth.verify-email'); // bu view’i birazdan oluşturacağız
})->middleware('auth')->name('verification.notice');

/**
 * 2. Maildeki linke tıklanınca tetiklenir
 */
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill(); // Kullanıcının email_verified_at sütununu doldurur
    return redirect('/dashboard'); // İstediğin sayfaya yönlendirebilirsin
})->middleware(['auth', 'signed'])->name('verification.verify');

/**
 * 3. "Tekrar gönder" butonuna basıldığında tetiklenir
 */
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Doğrulama e-postası tekrar gönderildi.');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return 'this verified';
    });
});


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('send-email-register-verify', function () {
    return view('mail.register_mail');
});
Route::get('backend/adm/login', function () {
    return view('admin.auth.login');
});

Route::group([
    'prefix' => 'backend/adm',
    'middleware' => AdminMiddleware::class,
], function () {
    // Route::get('/a', function () {
    //     return 'a';
    // });
    Route::get('', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::post('user-status', [UserController::class, 'updateStatus']);
    Route::post('user-permission-comment', [UserController::class, 'updatePermissionComment']);
});

Route::get('404', function () {
    return response()->view('layouts.404', [], 404);
});
Route::fallback(function () {
    return response()->view('layouts.404', [], 404);
});

Route::get('send-test-mail', [EmailController::class, 'sendEmail']);
