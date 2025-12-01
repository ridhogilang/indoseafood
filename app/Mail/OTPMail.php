<?php

namespace App\Mail;

use Log;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class OTPMail extends Mailable
{
    use Queueable, SerializesModels;

    public array $payload;

    /**
     * Constructor menerima array: ['id' => ..., 'otp' => ...]
     */
    public function __construct(array $payload)
    {
        $this->payload = $payload;
    }

    public function build()
    {
        // Wajib: copy data dari constructor
        $data = $this->payload;

        // Tambahkan field untuk template email
        $data['judul']        = 'Kode OTP Anda';
        $data['kata-kata'] = 'Below is your One-Time Password (OTP) for email verification or secure login to your account. Please enter this code to complete your authentication process and ensure the protection of your account and personal information.';
        $data['kode']         = $data['otp']; // ini yang ditampilkan

        return $this->subject('OTP Verifikasi')
            ->view('auth.otpmail')
            ->with('data', $data);
    }
}
