<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Request;

class PasswordChangedMail extends Mailable
{
    use SerializesModels;

    public $user;
    public $ip;
    public $datetime;

    public function __construct($user)
    {
        $this->user = $user;
        $this->ip = Request::ip();
        $this->datetime = now()->format('d.m.Y H:i');
    }

    public function build()
    {
        return $this->subject('Skazoknet.com - Ваш пароль изменен! ВНИМАНИЕ! НЕ ОТВЕЧАЙТЕ НА ЭТО ПИСЬМО!')
            ->markdown('emails.password.changed');
    }
}
