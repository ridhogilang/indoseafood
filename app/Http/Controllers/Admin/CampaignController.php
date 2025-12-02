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

        return view('admin.campaign.campaign', [
            'title' => 'Campaign Contact',
            'campaignContacts' => $campaignContacts,
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
        return view('admin.campaign.status_campaign', [
            'title' => 'Status Campaign Email',
        ]);
    }

    public function mail()
    {
        $campaign = EmailCampaign::findOrFail(1);

        return view('admin.campaign.mail', [
            'title' => 'Email Campaign',
            'campaign' => $campaign,
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

        $campaign->update([
            'title'     => $request->title,
            'subject'   => $request->subject,
            'body_html' => $request->body_html,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Email campaign template updated successfully.');
    }
}
