<?php

namespace App\Http\Controllers;

use App\Mail\RegisterEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail()
    {
        Mail::to('shatlyk1399@gmail.com')->send(new RegisterEmail());

        return response()->json(['success' => 'Email sent successfully.']);
    }
}
