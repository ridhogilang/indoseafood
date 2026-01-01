<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\PageView;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;

class TrackPageViews
{
    public function handle(Request $request, Closure $next)
    {
        // Skip admin pages
        if (!$request->is('admin*')) {

            $today = Carbon::today()->toDateString();

            $pageView = PageView::firstOrCreate(
                ['date' => $today],
                ['views' => 0]
            );

            $pageView->increment('views');
        }

        return $next($request);
    }
}
