<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class PasswordReset extends ResetPassword


{
    protected function buildMailMessage($url)
    {
        return (new MailMessage)
            ->subject(Lang::get('Upozornenie o resetovaní hesla'))
            ->greeting(Lang::get('Ahoj!'))
            ->line(Lang::get('Túto správu ste dostali, pretože sme dostali žiadosť o obnovenie hesla pre váš účet.'))
            ->action(Lang::get('Resetovať heslo.'), $url)
            ->line(Lang::get('Tento odkaz vyprší za :count minút.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]))
            ->line(Lang::get('Ak ste nepožiadali o obnovenie hesla, nie sú potrebné žiadne ďalšie kroky.'));
    }
}
