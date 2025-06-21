<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as BaseVerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class CustomVerifyEmail extends BaseVerifyEmail
{
    public function toMail($notifiable)
    {
        // $verifyUrl = $this->verificationUrl($notifiable);

        // return (new MailMessage)
        //     ->subject('Skazoknet.com - Регистрация на сайте! ВНИМАНИЕ! НЕ ОТВЕЧАЙТЕ НА ЭТО ПИСЬМО!')
        //     ->greeting('Поздравляем, ' . $notifiable->name . '!')
        //     ->line('Вы зарегистрировались на сайте Skazoknet.com, где вы можете делиться своими мнениями о жилых комплексах и застройщиках по всей России.')
        //     ->line('Чтобы завершить регистрацию, подтвердите свой email, нажав на кнопку ниже.')
        //     ->action('Подтвердить email', $verifyUrl)
        //     ->line('Спасибо за участие в проекте!')
        //     ->salutation('С уважением, SkazokNet');

        return (new MailMessage)
            ->subject('Skazoknet.com - Регистрация на сайте! ВНИМАНИЕ! НЕ ОТВЕЧАЙТЕ НА ЭТО ПИСЬМО!')
            ->view('notifications.email', [
                'user' => $notifiable,
                'url' => $this->verificationUrl($notifiable),
            ]);
    }
}
