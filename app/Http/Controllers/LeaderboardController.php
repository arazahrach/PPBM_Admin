<?php

namespace App\Http\Controllers;

use App\Models\Player;

class LeaderboardController extends Controller
{
    public function index()
        {
            $q = request('q');

            $base = Player::query()
                ->when($q, function ($query) use ($q) {
                    $query->where('account_name', 'like', "%{$q}%")
                        ->orWhere('email', 'like', "%{$q}%");
                });

            $top3 = (clone $base)->orderByDesc('score')->take(3)->get();

            $table = (clone $base)->orderByDesc('score')
                ->paginate(10)
                ->withQueryString();

            return view('leaderboard.index', compact('top3', 'table', 'q'));
        }

}
