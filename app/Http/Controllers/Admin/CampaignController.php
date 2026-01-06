<?php

namespace App\Http\Controllers\Admin;

use App\Models\EmailContact;
use Illuminate\Http\Request;
use App\Models\EmailCampaign;
use Illuminate\Support\Carbon;
use App\Jobs\SendCampaignEmailJob;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\EmailCampaignContact;
use Yajra\DataTables\Facades\DataTables;

class CampaignController extends Controller
{
    public function index()
    {
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

            // ============================
            // ✅ UPDATED SCHEDULING LOGIC
            // ============================

            // Ambil campaign contact TERAKHIR (ID terbesar)
            $lastCampaignContact = EmailCampaignContact::orderByDesc('id')->first();

            if ($lastCampaignContact && $lastCampaignContact->sent_at) {
                // Mulai 30 menit setelah email terakhir
                $nextSentAt = Carbon::parse($lastCampaignContact->sent_at)
                    ->addMinutes(30)
                    ->seconds(0);
            } else {
                // Belum pernah ada campaign sama sekali
                $nextSentAt = Carbon::now()->seconds(0);
            }

            foreach ($eligibleContacts as $contact) {

                // 4) Insert into email_campaign_contacts
                $campaignContact = EmailCampaignContact::create([
                    'email_campaign_id' => $campaignId,
                    'email_contact_id'  => $contact->id,
                    'status'            => 'pending',
                    'sent_at'           => $nextSentAt,
                ]);

                // 5) Mark contact as already used in campaign
                $contact->is_campaign = true;
                $contact->save();

                // 6) Dispatch job to actually send email at scheduled time
                SendCampaignEmailJob::dispatch($campaignContact->id)
                    ->onQueue('campaign')
                    ->delay($nextSentAt);

                // 👉 next email = +30 minutes
                $nextSentAt = $nextSentAt->copy()->addMinutes(30);
            }
        });

        return back()->with('success', 'Contacts have been moved to the campaign queue and email jobs have been scheduled.');
    }

    public function status()
    {
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
        })->count();

        $newLeads = EmailContact::where('is_campaign', false)->count();

        return view('admin.campaign.status_campaign', [
            'title' => 'Status Campaign Email',
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

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids'   => 'required|array',
            'ids.*' => 'exists:email_campaign_contacts,id',
        ]);

        DB::transaction(function () use ($request) {

            $items = EmailCampaignContact::whereIn('id', $request->ids)->get();

            foreach ($items as $item) {
                $contactId = $item->email_contact_id;
                $item->delete();

                if ($contactId) {
                    EmailContact::where('id', $contactId)
                        ->update(['is_campaign' => false]);
                }
            }
        });

        return response()->json([
            'success' => true,
            'message' => 'Selected campaign contacts have been deleted successfully.'
        ]);
    }

    public function datatable()
    {
        $query = EmailCampaignContact::with('contact')
            ->where('status', 'pending')
            ->orderBy('id', 'asc');

        return DataTables::of($query)
            ->addIndexColumn()

            // checkbox
            ->addColumn('checkbox', fn($c) => '
             <div class="custom-control custom-checkbox ms-1">
                 <input
            type="checkbox"
            class="custom-control-input checkbox checkbox-user"
            id="checkBox_' . $c->id . '"
            value="' . $c->id . '"
                 >
                <label class="custom-control-label" for="checkBox_' . $c->id . '"></label>
             </div>
                ')


            ->addColumn(
                'company',
                fn($c) =>
                trim($c->contact->company ?? '') ?: '-'
            )

            ->addColumn(
                'email',
                fn($c) =>
                trim($c->contact->kirim ?? '') ?: '-'
            )

            ->addColumn(
                'country',
                fn($c) =>
                trim($c->contact->country ?? '') ?: '-'
            )

            ->addColumn('schedule', function ($c) {
                if (!$c->sent_at) return '-';

                $dt = Carbon::parse($c->sent_at);
                return $dt->format('d M Y') . ' | ' . $dt->format('H.i');
            })

            ->addColumn('status', function ($c) {
                $now = Carbon::now();
                $threshold = $now->copy()->subMinutes(3);
                $sentAt = $c->sent_at ? Carbon::parse($c->sent_at) : null;

                $badgeMap = [
                    'pending' => ['Pending', 'badge bg-soft-warning text-warning'],
                    'sent'    => ['Sent', 'badge bg-soft-success text-success'],
                    'failed'  => ['Failed', 'badge bg-soft-danger text-danger'],
                ];

                $html = '<div class="' . $badgeMap[$c->status][1] . '">' . $badgeMap[$c->status][0] . '</div>';

                if ($c->status === 'pending' && $sentAt && $sentAt->lte($threshold)) {
                    $html .= '<div class="badge bg-soft-danger text-danger ms-1">Failed</div>';
                }

                return $html;
            })

            ->addColumn('action', function ($c) {
                return '
            <div class="hstack gap-2 justify-content-center">
                <form action="' . route('delete.campaign', $c->id) . '" method="POST">
                    ' . csrf_field() . method_field('DELETE') . '
                    <a href="javascript:void(0)" class="avatar-text avatar-md btn-delete-campaign">
                        <i class="feather feather-trash-2"></i>
                    </a>
                </form>
            </div>';
            })

            ->order(function ($query) {
                $query->orderBy('id', 'asc');
            })

            ->rawColumns(['checkbox', 'status', 'action'])
            ->filter(function ($query) {

                if ($search = request('search.value')) {

                    $query->where(function ($q) use ($search) {

                        // kolom utama
                        $q->where('status', 'LIKE', "%{$search}%")
                            ->orWhere('sent_at', 'LIKE', "%{$search}%");

                        // kolom relasi contact
                        $q->orWhereHas('contact', function ($qc) use ($search) {
                            $qc->where('company', 'LIKE', "%{$search}%")
                                ->orWhere('kirim', 'LIKE', "%{$search}%")
                                ->orWhere('country', 'LIKE', "%{$search}%");
                        });
                    });
                }
            })
            ->make(true);
    }

    public function statusDatatable()
    {
        $nowMinus3 = Carbon::now()->subMinutes(3);

        $query = EmailCampaignContact::with('contact')
            ->where(function ($q) use ($nowMinus3) {
                $q->whereIn('status', ['failed', 'sent'])
                    ->orWhere(function ($q2) use ($nowMinus3) {
                        $q2->where('status', 'pending')
                            ->where('sent_at', '<', $nowMinus3);
                    });
            });

        return DataTables::of($query)
            ->addIndexColumn()

            // checkbox
            ->addColumn('checkbox', fn($c) => '
                <div class="custom-control custom-checkbox ms-1">
                 <input
            type="checkbox"
            class="custom-control-input checkbox checkbox-user"
            id="checkBox_' . $c->id . '"
            value="' . $c->id . '"
             >
               <label class="custom-control-label" for="checkBox_' . $c->id . '"></label>
               </div>
            ')


            // company
            ->addColumn('company', fn($c) => optional($c->contact)->company ?: '-')

            // email
            ->addColumn('email', fn($c) => trim(optional($c->contact)->kirim) ?: '-')

            // country
            ->addColumn('country', fn($c) => optional($c->contact)->country ?: '-')

            // schedule
            ->addColumn('schedule', function ($c) {
                return $c->sent_at
                    ? Carbon::parse($c->sent_at)->format('d M Y') . ' | ' . Carbon::parse($c->sent_at)->format('H.i')
                    : '-';
            })

            // status badge (FULL SAMA CSS LAMA)
            ->addColumn('status', function ($c) {
                $now = Carbon::now();
                $threshold = $now->copy()->subMinutes(3);
                $sentAt = $c->sent_at ? Carbon::parse($c->sent_at) : null;

                $map = [
                    'pending' => ['Pending', 'badge bg-soft-warning text-warning'],
                    'sent'    => ['Sent', 'badge bg-soft-success text-success'],
                    'failed'  => ['Failed', 'badge bg-soft-danger text-danger'],
                ];

                $html = '<div class="' . $map[$c->status][1] . '">' . $map[$c->status][0] . '</div>';

                if ($c->status === 'pending' && $sentAt && $sentAt->lt($threshold)) {
                    $html .= '<div class="badge bg-soft-danger text-danger ms-1">Failed</div>';
                }

                return $html;
            })

            // action (DELETE – TIDAK DIUBAH)
            ->addColumn('action', function ($c) {
                return '
            <div class="hstack gap-2 justify-content-center">
                <form action="' . route('delete.campaign', $c->id) . '" method="POST">
                    ' . csrf_field() . method_field('DELETE') . '
                    <a href="javascript:void(0)" class="avatar-text avatar-md btn-delete-campaign">
                        <i class="feather feather-trash-2"></i>
                    </a>
                </form>
            </div>';
            })

            // FIX ERROR DT_RowIndex
            ->order(function ($q) {
                $q->orderBy('id', 'asc');
            })

            ->rawColumns(['checkbox', 'status', 'action'])
            ->make(true);
    }
}
