<?php

namespace App\Listeners;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordChangedMail;

class SendPasswordResetSuccessEmail
{
    public function handle(PasswordReset $event)
    {
        Mail::to($event->user->email)->send(new PasswordChangedMail($event->user));
    }
}
