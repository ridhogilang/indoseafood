<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InquiryNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public array $payload;

    public function __construct(array $payload)
    {
        $this->payload = $payload;
    }

    public function build()
    {
        $data = $this->payload;

        $data['title'] = 'New Inquiry Received';
        $data['year']  = now()->year;
        $data['url'] = route('inquiry.list');
        $data['message'] = 'A new inquiry has been submitted through the Indoseafood platform. Please review the details below and follow up as necessary.';

        return $this->subject('New Inquiry Notification')
            ->from('noreply@indoseafoods.com', 'IndoSeafood System')
            ->view('admin.inquiry.mail')
            ->with('data', $data)
            ->withSymfonyMessage(function ($message) {
                $message->getHeaders()->addTextHeader(
                    'Content-Transfer-Encoding',
                    'quoted-printable'
                );
            });
    }
}
