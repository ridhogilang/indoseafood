<?php

namespace App\Jobs;

use App\Models\EmailCampaignContact;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendCampaignEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected int $campaignContactId;

    // ⬇️ optional: atur batas waktu job ini (detik)
    public $timeout = 120;   // 2 menit
    public $tries   = 3;     // coba ulang max 3x sebelum dianggap failed

    public function __construct(int $campaignContactId)
    {
        $this->campaignContactId = $campaignContactId;
    }

    public function handle(): void
    {
        $campaignContact = EmailCampaignContact::with(['campaign', 'contact'])
            ->find($this->campaignContactId);

        if (! $campaignContact) {
            return;
        }

        $contact  = $campaignContact->contact;
        $campaign = $campaignContact->campaign;

        if (! $contact || empty($contact->kirim) || ! $campaign) {
            $campaignContact->status = 'failed';
            $campaignContact->save();
            return;
        }

        // ❗ (opsional) kamu boleh hapus try/catch di sini dan biarkan error naik ke Laravel
        try {
            $subject  = $campaign->subject ?? 'Campaign Email';
            $template = $campaign->body_html ?? '<p>No content.</p>';

            $bodyHtml = Blade::render($template, [
                'company' => $contact->company,
                'contact' => $contact,
            ]);

            Mail::html($bodyHtml, function ($message) use ($contact, $subject) {
                $message->to($contact->kirim, $contact->company)
                    ->subject($subject);
            });

            $campaignContact->status = 'sent';
            $campaignContact->save();
        } catch (\Throwable $e) {
            // Jika kamu mau tetap handle sendiri, tandai failed lalu lempar lagi
            Log::error('SendCampaignEmailJob error: ' . $e->getMessage());

            $campaignContact->status = 'failed';
            $campaignContact->save();

            // lempar lagi supaya Laravel tetap menandai job ini sebagai failed (masuk failed_jobs)
            throw $e;
        }
    }

    /**
     * Dipanggil otomatis oleh Laravel ketika job ini dinyatakan failed
     * (termasuk karena timeout).
     */
    public function failed(\Throwable $exception): void
    {
        $campaignContact = EmailCampaignContact::find($this->campaignContactId);

        if ($campaignContact) {
            $campaignContact->status = 'failed';
            $campaignContact->save();
        }

        Log::error('SendCampaignEmailJob FAILED: ' . $exception->getMessage());
    }
}
