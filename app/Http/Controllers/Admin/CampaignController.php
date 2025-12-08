<?php

namespace App\Http\Controllers\Admin;

use App\Models\EmailContact;
use Illuminate\Http\Request;
use App\Models\EmailCampaign;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\EmailCampaignContact;
use App\Jobs\SendCampaignEmailJob;

class CampaignController extends Controller
{
    public function index()
    {
        $campaignContacts = \App\Models\EmailCampaignContact::with(['campaign', 'contact'])
            ->where('status', 'pending') // hanya pending
            ->orderBy('id', 'asc')
            ->get();

        $now = Carbon::now();

        $runningCampaign = EmailCampaignContact::where('status', 'pending')
            ->where('sent_at', '>', $now)
            ->count();

        $failedCampaign = EmailCampaignContact::where(function ($q) use ($now) {

            $threeMinutesAgo = $now->copy()->subMinutes(3);

            $q->where('status', 'failed')
                ->orWhere(function ($sub) use ($threeMinutesAgo) {
                    $sub->where('status', 'pending')
                        ->where('sent_at', '<=', $threeMinutesAgo);
                });
        })
            ->count();


        $newLeads = EmailContact::where('is_campaign', false)->count();

        return view('admin.campaign.campaign', [
            'title' => 'Campaign Contact',
            'campaignContacts' => $campaignContacts,
            'runningCampaign' => $runningCampaign,
            'failedCampaign'  => $failedCampaign,
            'newLeads'        => $newLeads,
        ]);
    }

    public function start(Request $request)
    {
        // 1) Get all eligible contacts:
        // - 'kirim' must be filled
        // - not yet used in campaign (is_campaign = false)
        $eligibleContacts = EmailContact::whereNotNull('kirim')
            ->where('kirim', '!=', '')
            ->where('is_campaign', false)
            ->orderBy('id')
            ->get();

        if ($eligibleContacts->isEmpty()) {
            return back()->with('warning', 'There are no new contacts to add to the campaign.');
        }

        // 2) Global campaign id (pastikan id=1 ada di tabel email_campaigns)
        $campaignId = 1;

        DB::transaction(function () use ($eligibleContacts, $campaignId) {

            // 3) Scheduling logic for sent_at

            // How many contacts are already scheduled in ANY campaign?
            // (Global scheduling: 20 per day total)
            $existingCount = EmailCampaignContact::count();

            // Find the very first scheduled sent_at, if any
            $first = EmailCampaignContact::orderBy('sent_at', 'asc')->first();

            if ($first && $first->sent_at) {
                // Campaign system has already been started before
                $base = Carbon::parse($first->sent_at)->seconds(0);
            } else {
                // First time ever → start from now (uses app timezone, e.g. Asia/Jakarta)
                $base = Carbon::now()->seconds(0);
            }

            // We'll use:
            // - campaignStartDate: the date we started scheduling
            // - campaignStartTime: the time (hour:minute) we started scheduling
            $campaignStartDate = $base->copy()->startOfDay();
            $campaignStartTime = $base->copy();

            foreach ($eligibleContacts as $index => $contact) {
                // Global index across ALL scheduled records in email_campaign_contacts
                $globalIndex = $existingCount + $index;

                // Rules:
                // - 20 contacts per day
                // - 30 minutes apart
                $dayOffset = intdiv($globalIndex, 20);  // 0,1,2,... each 20 contacts → next day
                $slotInDay = $globalIndex % 20;        // 0..19 position in the day

                $sentAt = $campaignStartDate
                    ->copy()
                    ->addDays($dayOffset)
                    ->setTime(
                        $campaignStartTime->hour,
                        $campaignStartTime->minute,
                        0
                    )
                    ->addMinutes($slotInDay * 30);

                // 4) Insert into email_campaign_contacts
                $campaignContact = EmailCampaignContact::create([
                    'email_campaign_id' => $campaignId,
                    'email_contact_id'  => $contact->id,
                    'status'            => 'pending',   // default
                    'sent_at'           => $sentAt,
                ]);

                // 5) Mark contact as already used in campaign
                $contact->is_campaign = true;
                $contact->save();

                // 6) Dispatch job to actually send email at scheduled time
                SendCampaignEmailJob::dispatch($campaignContact->id)
                    ->delay($sentAt);
            }
        });

        return back()->with('success', 'Contacts have been moved to the campaign queue and email jobs have been scheduled.');
    }


    public function status()
    {
        $nowMinus3 = Carbon::now()->subMinutes(3);

        $campaignContacts = \App\Models\EmailCampaignContact::with(['campaign', 'contact'])
            ->where(function ($q) use ($nowMinus3) {
                $q->whereIn('status', ['failed', 'sent'])
                    ->orWhere(function ($q2) use ($nowMinus3) {
                        // pending tapi sudah melewati waktu + 3 menit
                        $q2->where('status', 'pending')
                            ->where('sent_at', '<', $nowMinus3);
                    });
            })
            ->orderBy('id', 'asc')
            ->get();

        $now = Carbon::now();

        $runningCampaign = EmailCampaignContact::where('status', 'pending')
            ->where('sent_at', '>', $now)
            ->count();

        $failedCampaign = EmailCampaignContact::where(function ($q) use ($now) {

            $threeMinutesAgo = $now->copy()->subMinutes(3);

            $q->where('status', 'failed')
                ->orWhere(function ($sub) use ($threeMinutesAgo) {
                    $sub->where('status', 'pending')
                        ->where('sent_at', '<=', $threeMinutesAgo);
                });
        })
            ->count();


        $newLeads = EmailContact::where('is_campaign', false)->count();

        return view('admin.campaign.status_campaign', [
            'title' => 'Status Campaign Email',
            'campaignContacts' => $campaignContacts,
            'runningCampaign' => $runningCampaign,
            'failedCampaign'  => $failedCampaign,
            'newLeads'        => $newLeads,
        ]);
    }

    public function mail()
    {
        $campaign = EmailCampaign::findOrFail(1);

        $now = Carbon::now();

        $hasFutureScheduled = EmailCampaignContact::where('email_campaign_id', $campaign->id)
            ->where('status', 'pending')
            ->where('sent_at', '>', $now)
            ->exists();

        return view('admin.campaign.mail', [
            'title' => 'Email Campaign',
            'campaign' => $campaign,
            'hasFutureScheduled' => $hasFutureScheduled,
        ]);
    }

    public function updateTemplate(Request $request)
    {
        $campaign = EmailCampaign::findOrFail(1);

        $request->validate([
            'title'     => ['required', 'string', 'max:255'],
            'subject'   => ['required', 'string', 'max:255'],
            'body_html' => ['required', 'string'],
        ]);

        // Sedikit normalisasi HTML supaya jarak antar paragraf nggak lebay
        $cleanBody = $this->normalizeBodyHtml($request->body_html);

        $campaign->update([
            'title'     => $request->title,
            'subject'   => $request->subject,
            'body_html' => $cleanBody,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Email campaign template updated successfully.');
    }

    protected function normalizeBodyHtml(string $html): string
    {
        // Kurangi margin yang terlalu besar (12px → 8px)
        $html = preg_replace(
            '/margin:\s*12px 0;/i',
            'margin:8px 0;',
            $html
        );

        // Kurangi line-height sedikit (opsional, biar nggak terlalu renggang)
        $html = preg_replace(
            '/line-height:\s*1\.5;/i',
            'line-height:1.4;',
            $html
        );

        // Hapus paragraf kosong (<p>&nbsp;</p> dsb)
        $html = preg_replace(
            '/<p[^>]*>(?:&nbsp;|\s)*<\/p>/i',
            '',
            $html
        );

        return $html;
    }

    public function deleteCampaignContact($id)
    {
        // Cari record di email_campaign_contacts
        $item = EmailCampaignContact::findOrFail($id);

        // Ambil contact id nya
        $contactId = $item->email_contact_id;

        // Delete item campaign contact
        $item->delete();

        // Update email_contacts → is_campaign = false
        $contact = EmailContact::find($contactId);
        if ($contact) {
            $contact->is_campaign = false;
            $contact->save();
        }

        return back()->with('success', 'Campaign contact has been deleted successfully.');
    }
}
