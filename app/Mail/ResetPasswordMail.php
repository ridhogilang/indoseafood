<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($resetData)
    {
        $this->data = $resetData;
    }

    public function build()
    {
        $this->data['url'] = route('password.reset', [
            'token' => $this->data['token'],
            'email' => $this->data['email'],
        ]);
        
        return $this->from('noreply@indoseafoods.com', 'IndoSeafood System')
            ->replyTo('support@indoseafoods.com', 'IndoSeafood Support')
            ->subject('Reset Your IndoSeafood Password')
            ->view('auth.forgotmail')
            ->with('data', $this->data);
    }
}
