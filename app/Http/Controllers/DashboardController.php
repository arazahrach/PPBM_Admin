<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $last7 = $now->copy()->subDays(7);
        $last30 = $now->copy()->subDays(30);

        $realtimeUsers = Player::whereNotNull('last_active_at')
        ->where('last_active_at', '>=', now()->subMinutes(5))
        ->count();


        $totalVisits = (int) Player::sum('total_visits');

        // average duration (seconds) per player session aggregate, simple:
        // avg = total_session_seconds / max(total_visits,1)
        $sumSessionSeconds = (int) Player::sum('total_session_seconds');
        $sumVisits = max($totalVisits, 1);
        $avgSeconds = intdiv($sumSessionSeconds, $sumVisits);

        $activeUsers7d = Player::whereNotNull('last_active_at')
            ->where('last_active_at', '>=', $last7)
            ->count();

        $signups30d = Player::where('created_at', '>=', $last30)->count();

        return view('dashboard.index', compact(
            'realtimeUsers',
            'totalVisits',
            'avgSeconds',
            'activeUsers7d',
            'signups30d'
        ));

        
    }
}
