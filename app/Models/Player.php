<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class Player extends Model
{
    protected $fillable = [
        'account_name',
        'email',
        'password_hash',
        'profile_photo',
        'rank',
        'status',
        'in_lobby',
        'score',
    ];

    protected $casts = [
    'rank' => 'integer',
    'in_lobby' => 'boolean',
    'score' => 'integer',
    'total_visits' => 'integer',
    'total_session_seconds' => 'integer',
    'last_active_at' => 'datetime',
    ];


    public const RANKS = [
        1 => 'Bronze',
        2 => 'Silver',
        3 => 'Gold',
        4 => 'Platinum',
        5 => 'Diamond',
    ];

    public function rankLabel(): string
    {
        return self::RANKS[$this->rank] ?? 'Unknown';
    }


public function avatarUrl(): string
{
    if ($this->profile_photo && Storage::disk('public')->exists($this->profile_photo)) {
        return Storage::url($this->profile_photo); // /storage/...
    }
    return 'https://via.placeholder.com/96'; // fallback aman
}

public function rewardDiamonds(): int
{
    // base reward per rank
    $base = match ((int) $this->rank) {
        1 => 200,   // bronze
        2 => 500,   // silver
        3 => 1000,  // gold
        default => 200,
    };

    // bonus tiap 10.000 score
    $bonus = intdiv((int) $this->score, 10000) * 50;

    return $base + $bonus;
}


public function isOnline(int $minutes = 5): bool
{
    if (!$this->last_active_at) return false;
    return $this->last_active_at->greaterThanOrEqualTo(now()->subMinutes($minutes));
}

public function statusLabel(): string
{
    return $this->isOnline() ? 'online' : 'offline';
}



}
