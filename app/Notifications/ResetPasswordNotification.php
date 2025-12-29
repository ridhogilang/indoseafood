<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Mail\ResetPasswordMail;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $data = [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
            'name'  => $notifiable->name,
        ];

        return (new ResetPasswordMail($data))->to($notifiable->email);
    }
}
