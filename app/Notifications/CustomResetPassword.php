<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Request;

class CustomResetPassword extends ResetPassword
{
    public function toMail($notifiable)
    {
        $ip = Request::ip();
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        // return (new MailMessage)
        //     ->subject('Skazoknet.com - Восстановление пароля! ВНИМАНИЕ! НЕ ОТВЕЧАЙТЕ НА ЭТО ПИСЬМО!')
        //     ->greeting('Здравствуйте, ' . ($notifiable->name ?? 'пользователь') . '.')
        //     ->line("На ваш email поступил запрос восстановления пароля с IP адреса: $ip.")
        //     ->action('Восстановить пароль', $url)
        //     ->line('Если кнопка не нажимается, попробуйте скопировать ссылку и вставить её в адресную строку браузера вручную:')
        //     ->line($url)
        //     ->line('Если вы не отправляли запрос на восстановление пароля, то просто проигнорируйте это сообщение.')
        //     ->salutation("С уважением,\nсервис СказокНет \nЭто письмо отправлено роботом и любой ответ на его email не будет получен.
        //     Для связи с техподдержкой СказокНет используйте форму обратной связи.");
        return (new MailMessage)
            ->view('vendor.notifications.password_reset', [
                'user' => $notifiable,
                'url' => $url,
                'ip' => $ip,
            ])
            ->subject('Skazoknet.com - Восстановление пароля! ВНИМАНИЕ! НЕ ОТВЕЧАЙТЕ НА ЭТО ПИСЬМО!');
    }
}
