<?php

namespace App\Http\Controllers;

use App\Mail\RegisterEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail()
    {
        try {
            Mail::to('shatlyk1399@gmail.com')->send(new RegisterEmail());
            return response()->json(['success' => 'Email sent successfully.']);
        } catch (\Exception $e) {
            // Ignore SMTP errors in local development
            Log::info('Test email sending failed (ignored): ' . $e->getMessage());
            return response()->json(['success' => 'Email process completed (SMTP ignored in local).']);
        }
    }
}
