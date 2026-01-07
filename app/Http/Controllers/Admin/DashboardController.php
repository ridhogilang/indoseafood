<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\Inquiry;
use App\Models\PageView;
use App\Models\EmailContact;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\EmailCampaignContact;


class DashboardController extends Controller
{
    public function index()
    {
        $start = Carbon::now()->subDays(29)->startOfDay();
        $end   = Carbon::now()->endOfDay();
        $now = Carbon::now();

        // Campaign progress
        $totalCampaign = EmailCampaignContact::whereBetween('created_at', [$start, $end])->count();

        $sentCampaign = EmailCampaignContact::whereBetween('created_at', [$start, $end])
            ->where('status', 'sent')
            ->count();

        $waitingCampaign = EmailCampaignContact::whereBetween('created_at', [$start, $end])
            ->whereIn('status', ['pending', 'failed'])
            ->count();

        $progressPercent = $totalCampaign > 0
            ? round(($sentCampaign / $totalCampaign) * 100)
            : 0;

        // Article stats
        $articlePublished = Article::where('is_published', true)
            ->where('status', 'published')
            ->count();

        $articleWaiting = Article::where('is_published', false)
            ->where('status', 'draft')
            ->count();

        $articleTotal = $articlePublished + $articleWaiting;

        $articlePercent = $articleTotal > 0
            ? round(($articlePublished / $articleTotal) * 100)
            : 0;

        // Inquiry stats
        $inquiryTotal = Inquiry::count();

        $inquiryCompleted = Inquiry::where('status', 'archived')->count();

        $inquiryInProgress = Inquiry::where('status', '!=', 'archived')->count();

        $inquiryPercent = $inquiryTotal > 0
            ? round(($inquiryCompleted / $inquiryTotal) * 100)
            : 0;

        // Campaign daily chart data
        $totalCurrent = EmailCampaignContact::where('status', 'sent')
            ->whereBetween('sent_at', [$start, $end])
            ->count();

        $totalPrevious = EmailCampaignContact::where('status', 'sent')
            ->whereBetween('sent_at', [$start->copy()->subDays(30), $start->copy()->subDay()])
            ->count();

        if ($totalPrevious == 0) {
            $percentChange = $totalCurrent * 100; // bulan lalu 0 → current * 100%
        } else {
            $percentChange = round((($totalCurrent - $totalPrevious) / $totalPrevious) * 100);
        }

        // Buat trend text
        $trendText = $percentChange >= 0
            ? "$percentChange% more"
            : abs($percentChange) . "% less";

        $campaignDaily = EmailCampaignContact::select(
            DB::raw('DATE(sent_at) as date'),
            DB::raw('COUNT(*) as total')
        )
            ->where('status', 'sent')
            ->whereBetween('sent_at', [$start, $end])
            ->groupBy(DB::raw('DATE(sent_at)'))
            ->orderBy('date')
            ->get()
            ->pluck('total', 'date');

        $campaignSentDailyLabels = [];
        $campaignSentDailyData   = [];

        for ($i = 0; $i < 30; $i++) {
            $date = $start->copy()->addDays($i)->format('Y-m-d');

            $campaignSentDailyLabels[] = Carbon::parse($date)->format('d M');
            $campaignSentDailyData[]   = $campaignDaily[$date] ?? 0;
        }

        // Inquiry daily chart data
        $inquiriesDaily = Inquiry::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as total')
        )
            ->whereBetween('created_at', [$start, $end])
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date')
            ->get()
            ->pluck('total', 'date');

        $inquiriesDailyLabels = [];
        $inquiriesDailyData   = [];

        $current = $start->copy();
        while ($current->lte($end)) { // sampai termasuk tanggal end
            $date = $current->format('Y-m-d');
            $inquiriesDailyLabels[] = $current->format('d M');
            $inquiriesDailyData[]   = $inquiriesDaily[$date] ?? 0;
            $current->addDay();
        }

        $inquiriesTotalCurrent = Inquiry::whereBetween('created_at', [$start, $end])->count();

        $inquiriesTotalPrevious = Inquiry::whereBetween('created_at', [$start->copy()->subDays(30), $start->copy()->subDay()])->count();

        if ($inquiriesTotalPrevious == 0) {
            // Bulan lalu 0 → pakai current * 100%
            $inquiriesPercentChange = $inquiriesTotalCurrent * 100;
        } else {
            $inquiriesPercentChange = round((($inquiriesTotalCurrent - $inquiriesTotalPrevious) / $inquiriesTotalPrevious) * 100);
        }

        // Buat trend text
        $inquiriesTrendText = $inquiriesPercentChange >= 0
            ? "$inquiriesPercentChange% more"
            : abs($inquiriesPercentChange) . "% less";

        // Campaign table data
        $nowMinus3 = Carbon::now()->subMinutes(3);

        $CampaignTable = EmailCampaignContact::with('contact')
            ->where(function ($query) use ($nowMinus3) {
                $query->where('status', 'failed')
                    ->orWhere(function ($q) use ($nowMinus3) {
                        $q->where('status', 'pending')
                            ->where('sent_at', '<', $nowMinus3);
                    });
            })
            ->orderBy('sent_at', 'desc')
            ->paginate(5);

        //Inquiries table data
        $inquiriesTable = Inquiry::where('status', 'new')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        // Page Views Data
        $pageViewsCurrent = PageView::whereBetween(
            'date',
            [$start->toDateString(), $end->toDateString()]
        )->sum('views');

        $pageViewsPrevious = PageView::whereBetween(
            'date',
            [
                $start->copy()->subDays(30)->toDateString(),
                $start->copy()->subDay()->toDateString()
            ]
        )->sum('views');

        if ($pageViewsPrevious == 0) {
            $pageViewsPercentChange = $pageViewsCurrent * 100;
        } else {
            $pageViewsPercentChange = round(
                (($pageViewsCurrent - $pageViewsPrevious) / $pageViewsPrevious) * 100
            );
        }

        $pageViewsTrendText = $pageViewsPercentChange >= 0
            ? $pageViewsPercentChange . '% change'
            : abs($pageViewsPercentChange) . '% change';

        $pageViewsTrendIcon = $pageViewsPercentChange >= 0
            ? 'feather-trending-up'
            : 'feather-trending-down';

        // Total Leads Data
        $totalLeadsCurrent = EmailContact::whereBetween(
            'created_at',
            [$start, $end]
        )->count();

        $totalLeadsPrevious = EmailContact::whereBetween(
            'created_at',
            [
                $start->copy()->subDays(30),
                $start->copy()->subDay()
            ]
        )->count();

        if ($totalLeadsPrevious == 0) {
            $totalLeadsPercentChange = $totalLeadsCurrent * 100;
        } else {
            $totalLeadsPercentChange = round(
                (($totalLeadsCurrent - $totalLeadsPrevious) / $totalLeadsPrevious) * 100
            );
        }

        $totalLeadsTrendText = $totalLeadsPercentChange >= 0
            ? $totalLeadsPercentChange . '% change'
            : abs($totalLeadsPercentChange) . '% change';

        $totalLeadsTrendIcon = $totalLeadsPercentChange >= 0
            ? 'feather-trending-up'
            : 'feather-trending-down';

        //Campaign success
        $campaignSuccessLast30Days = EmailCampaignContact::where('status', 'sent')
            ->whereNotNull('sent_at')
            ->whereBetween('sent_at', [$start, $end])->count();

        $prevStart = (clone $start)->subDays(30);
        $prevEnd   = (clone $start)->subSecond();

        $campaignSuccessPrev30Days = EmailCampaignContact::where('status', 'sent')
            ->whereNotNull('sent_at')
            ->whereBetween('sent_at', [$prevStart, $prevEnd])->count();

        if ($campaignSuccessPrev30Days > 0) {
            $campaignPercentChange = (
                ($campaignSuccessLast30Days - $campaignSuccessPrev30Days)
                / $campaignSuccessPrev30Days
            ) * 100;
        } else {
            $campaignPercentChange = $campaignSuccessLast30Days > 0 ? 100 : 0;
        }

        $campaignPercentChange = round($campaignPercentChange, 1);

        $campaignTrendIcon = $campaignPercentChange >= 0
            ? 'feather-trending-up'
            : 'feather-trending-down';

        // Inquiries last 30 days
        $inquiriesLast30Days = Inquiry::whereBetween('created_at', [$start, $end])
            ->count();

        $inquiriesPrev30Days = Inquiry::whereBetween('created_at', [$prevStart, $prevEnd])
            ->count();

        if ($inquiriesPrev30Days > 0) {
            $inquiriesPercentChange = (
                ($inquiriesLast30Days - $inquiriesPrev30Days)
                / $inquiriesPrev30Days
            ) * 100;
        } else {
            $inquiriesPercentChange = $inquiriesLast30Days > 0 ? 100 : 0;
        }

        $inquiriesPercentChange = round($inquiriesPercentChange, 1);

        $inquiriesTrendIcon = $inquiriesPercentChange >= 0
            ? 'feather-trending-up'
            : 'feather-trending-down';

        return view('admin.dashboard', [
            'title' => 'Dashboard',
            'campaignTotal' => $totalCampaign,
            'campaignSent' => $sentCampaign,
            'campaignWaiting' => $waitingCampaign,
            'campaignPercent' => $progressPercent,
            'articlePublished' => $articlePublished,
            'articleWaiting' => $articleWaiting,
            'articleTotal' => $articleTotal,
            'articlePercent' => $articlePercent,
            'inquiryTotal' => $inquiryTotal,
            'inquiryCompleted' => $inquiryCompleted,
            'inquiryInProgress' => $inquiryInProgress,
            'inquiryPercent' => $inquiryPercent,
            'campaignSentDailyData'   => $campaignSentDailyData,
            'campaignSentDailyLabels' => $campaignSentDailyLabels,
            'trendText' => $trendText,
            'inquiriesDailyLabels' => $inquiriesDailyLabels,
            'inquiriesDailyData' => $inquiriesDailyData,
            'inquiriesTrendText' => $inquiriesTrendText,
            'campaignTable' => $CampaignTable,
            'inquiriesTable' => $inquiriesTable,
            'pageViewsCurrent' => $pageViewsCurrent,
            'pageViewsPercentChange' => $pageViewsPercentChange,
            'pageViewsTrendText' => $pageViewsTrendText,
            'pageViewsTrendIcon'   => $pageViewsTrendIcon,
            'totalLeadsCurrent' => $totalLeadsCurrent,
            'totalLeadsPercentChange' => $totalLeadsPercentChange,
            'totalLeadsTrendText' => $totalLeadsTrendText,
            'totalLeadsTrendIcon' => $totalLeadsTrendIcon,
            'campaignSuccessTotal' => $campaignSuccessLast30Days,
            'campaignPercentChange' => $campaignPercentChange,
            'campaignTrendIcon' => $campaignTrendIcon,
            'inquiriesLast30Days' => $inquiriesLast30Days,
            'inquiriesPercentChange' => $inquiriesPercentChange,
            'inquiriesTrendIcon' => $inquiriesTrendIcon,
        ]);
    }

    public function filter(Request $request)
    {
        $start = $request->filled('start_date')
            ? Carbon::parse($request->start_date)->startOfDay()
            : Carbon::now()->subDays(29)->startOfDay();

        $end = $request->filled('end_date')
            ? Carbon::parse($request->end_date)->endOfDay()
            : Carbon::now()->endOfDay();

        $days = $start->diffInDays($end) + 1;

        // periode sebelumnya (panjang sama)
        $prevStart = $start->copy()->subDays($days);
        $prevEnd   = $start->copy()->subDay();

        //Campaign Statis
        $totalCampaign = EmailCampaignContact::whereBetween('created_at', [$start, $end])
            ->count();

        $sentCampaign = EmailCampaignContact::whereBetween('created_at', [$start, $end])
            ->where('status', 'sent')
            ->count();

        $waitingCampaign = EmailCampaignContact::whereBetween('created_at', [$start, $end])
            ->whereIn('status', ['pending', 'failed'])
            ->count();

        $progressPercent = $totalCampaign > 0
            ? round(($sentCampaign / $totalCampaign) * 100)
            : 0;

        // Article stats
        $articlePublished = Article::where('is_published', true)
            ->where('status', 'published')
            ->whereBetween('created_at', [$start, $end])
            ->count();

        $articleWaiting = Article::where('is_published', false)
            ->where('status', 'draft')
            ->whereBetween('created_at', [$start, $end])
            ->count();

        $articleTotal = $articlePublished + $articleWaiting;

        $articlePercent = $articleTotal > 0
            ? round(($articlePublished / $articleTotal) * 100)
            : 0;

        // Inquiry stats
        $inquiryTotal = Inquiry::whereBetween('created_at', [$start, $end])
            ->count();

        $inquiryCompleted = Inquiry::where('status', 'archived')
            ->whereBetween('created_at', [$start, $end])
            ->count();

        $inquiryInProgress = Inquiry::where('status', '!=', 'archived')
            ->whereBetween('created_at', [$start, $end])
            ->count();

        $inquiryPercent = $inquiryTotal > 0
            ? round(($inquiryCompleted / $inquiryTotal) * 100)
            : 0;

        // daily campaign chart
        $totalCurrent = EmailCampaignContact::where('status', 'sent')
            ->whereBetween('sent_at', [$start, $end])
            ->count();

        $totalPrevious = EmailCampaignContact::where('status', 'sent')
            ->whereBetween('sent_at', [$prevStart, $prevEnd])
            ->count();

        if ($totalPrevious == 0 && $totalCurrent > 0) {
            $percentChange = $totalCurrent * 100;
        } elseif ($totalPrevious == 0) {
            $percentChange = 0;
        } else {
            $percentChange = round((($totalCurrent - $totalPrevious) / $totalPrevious) * 100);
        }

        $trendText = $percentChange >= 0
            ? "{$percentChange}% more"
            : abs($percentChange) . "% less";

        $campaignDaily = EmailCampaignContact::select(
            DB::raw('DATE(sent_at) as date'),
            DB::raw('COUNT(*) as total')
        )
            ->where('status', 'sent')
            ->whereBetween('sent_at', [$start, $end])
            ->groupBy(DB::raw('DATE(sent_at)'))
            ->orderBy('date')
            ->get()
            ->pluck('total', 'date');

        $campaignSentDailyLabels = [];
        $campaignSentDailyData   = [];

        for ($i = 0; $i < $days; $i++) {
            $date = $start->copy()->addDays($i)->format('Y-m-d');

            $campaignSentDailyLabels[] = Carbon::parse($date)->format('d M');
            $campaignSentDailyData[]   = $campaignDaily[$date] ?? 0;
        }

        // =========================
        // Inquiry daily chart data
        // =========================
        $inquiriesDaily = Inquiry::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as total')
        )
            ->whereBetween('created_at', [$start, $end])
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date')
            ->get()
            ->pluck('total', 'date');

        $inquiriesDailyLabels = [];
        $inquiriesDailyData   = [];

        for ($i = 0; $i < $days; $i++) {
            $date = $start->copy()->addDays($i)->format('Y-m-d');

            $inquiriesDailyLabels[] = Carbon::parse($date)->format('d M');
            $inquiriesDailyData[]   = $inquiriesDaily[$date] ?? 0;
        }

        $inquiriesTotalCurrent = Inquiry::whereBetween('created_at', [$start, $end])
            ->count();

        $inquiriesTotalPrevious = Inquiry::whereBetween('created_at', [$prevStart, $prevEnd])
            ->count();

        if ($inquiriesTotalPrevious == 0 && $inquiriesTotalCurrent > 0) {
            $inquiriesPercentChange = $inquiriesTotalCurrent * 100;
        } elseif ($inquiriesTotalPrevious == 0) {
            $inquiriesPercentChange = 0;
        } else {
            $inquiriesPercentChange = round(
                (($inquiriesTotalCurrent - $inquiriesTotalPrevious) / $inquiriesTotalPrevious) * 100
            );
        }

        $inquiriesTrendText = $inquiriesPercentChange >= 0
            ? "{$inquiriesPercentChange}% more"
            : abs($inquiriesPercentChange) . "% less";

        $nowMinus3 = Carbon::now()->subMinutes(3);

        $CampaignTable = EmailCampaignContact::with('contact')
            ->where(function ($query) use ($nowMinus3) {
                $query->where('status', 'failed')
                    ->orWhere(function ($q) use ($nowMinus3) {
                        $q->where('status', 'pending')
                            ->where('sent_at', '<', $nowMinus3);
                    });
            })
            ->orderBy('sent_at', 'desc')
            ->paginate(5);

        //Inquiries table data
        $inquiriesTable = Inquiry::where('status', 'new')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        // =========================
        // Page Views stats (by date range)
        // =========================
        $pageViewsCurrent = PageView::whereBetween(
            'date',
            [$start->toDateString(), $end->toDateString()]
        )
            ->sum('views');

        $pageViewsPrevious = PageView::whereBetween(
            'date',
            [$prevStart->toDateString(), $prevEnd->toDateString()]
        )
            ->sum('views');

        if ($pageViewsPrevious == 0 && $pageViewsCurrent > 0) {
            $pageViewsPercentChange = $pageViewsCurrent * 100;
        } elseif ($pageViewsPrevious == 0) {
            $pageViewsPercentChange = 0;
        } else {
            $pageViewsPercentChange = round(
                (($pageViewsCurrent - $pageViewsPrevious) / $pageViewsPrevious) * 100
            );
        }

        $pageViewsTrendText = $pageViewsPercentChange >= 0
            ? $pageViewsPercentChange . '% change'
            : abs($pageViewsPercentChange) . '% change';

        $pageViewsTrendIcon = $pageViewsPercentChange >= 0
            ? 'feather-trending-up'
            : 'feather-trending-down';

        // =========================
        // Total Leads Data
        // =========================

        $totalLeadsCurrent = EmailContact::whereBetween('created_at', [$start, $end])
            ->count();

        $totalLeadsPrevious = EmailContact::whereBetween('created_at', [$prevStart, $prevEnd])
            ->count();

        if ($totalLeadsPrevious == 0 && $totalLeadsCurrent > 0) {
            $totalLeadsPercentChange = $totalLeadsCurrent * 100;
        } elseif ($totalLeadsPrevious == 0) {
            $totalLeadsPercentChange = 0;
        } else {
            $totalLeadsPercentChange = round(
                (($totalLeadsCurrent - $totalLeadsPrevious) / $totalLeadsPrevious) * 100
            );
        }

        $totalLeadsTrendText = $totalLeadsPercentChange >= 0
            ? $totalLeadsPercentChange . '% change'
            : abs($totalLeadsPercentChange) . '% change';

        $totalLeadsTrendIcon = $totalLeadsPercentChange >= 0
            ? 'feather-trending-up'
            : 'feather-trending-down';


        // =========================
        // Campaign success
        // =========================

        $campaignSuccessCurrent = EmailCampaignContact::where('status', 'sent')
            ->whereNotNull('sent_at')
            ->whereBetween('sent_at', [$start, $end])->count();

        $campaignSuccessPrevious = EmailCampaignContact::where('status', 'sent')
            ->whereNotNull('sent_at')
            ->whereBetween('sent_at', [$prevStart, $prevEnd])->count();

        if ($campaignSuccessPrevious == 0 && $campaignSuccessCurrent > 0) {
            $campaignPercentChange = $campaignSuccessCurrent * 100;
        } elseif ($campaignSuccessPrevious == 0) {
            $campaignPercentChange = 0;
        } else {
            $campaignPercentChange = round(
                (($campaignSuccessCurrent - $campaignSuccessPrevious) / $campaignSuccessPrevious) * 100,
                1
            );
        }

        $campaignTrendIcon = $campaignPercentChange >= 0
            ? 'feather-trending-up'
            : 'feather-trending-down';


        // =========================
        // Inquiries data
        // =========================

        $inquiriesCurrent = Inquiry::whereBetween('created_at', [$start, $end])
            ->count();

        $inquiriesPrevious = Inquiry::whereBetween('created_at', [$prevStart, $prevEnd])
            ->count();

        if ($inquiriesPrevious == 0 && $inquiriesCurrent > 0) {
            $inquiriesPercentChange = $inquiriesCurrent * 100;
        } elseif ($inquiriesPrevious == 0) {
            $inquiriesPercentChange = 0;
        } else {
            $inquiriesPercentChange = round(
                (($inquiriesCurrent - $inquiriesPrevious) / $inquiriesPrevious) * 100,
                1
            );
        }

        $inquiriesTrendIcon = $inquiriesPercentChange >= 0
            ? 'feather-trending-up'
            : 'feather-trending-down';

        return view('admin.dashboard', [
            'title' => 'Dashboard',
            'campaignTotal' => $totalCampaign,
            'campaignSent' => $sentCampaign,
            'campaignWaiting' => $waitingCampaign,
            'campaignPercent' => $progressPercent,
            'articlePublished' => $articlePublished,
            'articleWaiting' => $articleWaiting,
            'articleTotal' => $articleTotal,
            'articlePercent' => $articlePercent,
            'inquiryTotal' => $inquiryTotal,
            'inquiryCompleted' => $inquiryCompleted,
            'inquiryInProgress' => $inquiryInProgress,
            'inquiryPercent' => $inquiryPercent,
            'campaignSentDailyData'   => $campaignSentDailyData,
            'campaignSentDailyLabels' => $campaignSentDailyLabels,
            'trendText' => $trendText,
            'inquiriesDailyLabels' => $inquiriesDailyLabels,
            'inquiriesDailyData' => $inquiriesDailyData,
            'inquiriesTrendText' => $inquiriesTrendText,
            'campaignTable' => $CampaignTable,
            'inquiriesTable' => $inquiriesTable,
            'pageViewsCurrent' => $pageViewsCurrent,
            'pageViewsPercentChange' => $pageViewsPercentChange,
            'pageViewsTrendText' => $pageViewsTrendText,
            'pageViewsTrendIcon'   => $pageViewsTrendIcon,
            'totalLeadsCurrent' => $totalLeadsCurrent,
            'totalLeadsPercentChange' => $totalLeadsPercentChange,
            'totalLeadsTrendText' => $totalLeadsTrendText,
            'totalLeadsTrendIcon' => $totalLeadsTrendIcon,
            'campaignSuccessTotal' => $campaignSuccessCurrent,
            'campaignPercentChange' => $campaignPercentChange,
            'campaignTrendIcon' => $campaignTrendIcon,
            'inquiriesTotal'       => $inquiriesCurrent,
            'inquiriesPercentChange' => $inquiriesPercentChange,
            'inquiriesTrendIcon' => $inquiriesTrendIcon,
        ]);
    }
}
