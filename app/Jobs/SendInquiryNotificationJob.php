<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Inquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\InquiryNotificationMail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendInquiryNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    public $timeout = 120;

    public Inquiry $inquiry;

    public function __construct(Inquiry $inquiry)
    {
        $this->inquiry = $inquiry;
    }

    public function handle(): void
    {
        $users = User::where('is_notification', true)->get();

        foreach ($users as $user) {
            Mail::mailer('smtp')
                ->to($user->email)
                ->send(
                    new InquiryNotificationMail([
                        'company_name' => $this->inquiry->company_name,
                        'email'        => $this->inquiry->email,
                        'fish_name'    => $this->inquiry->fish_name,
                        'qty'          => $this->inquiry->qty,
                        'destination'  => $this->inquiry->port_of_destination,
                    ])
                );
        }
    }
}
