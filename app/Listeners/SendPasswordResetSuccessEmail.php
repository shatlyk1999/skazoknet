<?php

namespace App\Listeners;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordChangedMail;
use Illuminate\Support\Facades\Log;

class SendPasswordResetSuccessEmail
{
    public function handle(PasswordReset $event)
    {
        try {
            Mail::to($event->user->email)->send(new PasswordChangedMail($event->user));
        } catch (\Exception $e) {
            // Ignore SMTP errors in local development
            Log::info('Password reset email sending failed (ignored): ' . $e->getMessage());
        }
    }
}
