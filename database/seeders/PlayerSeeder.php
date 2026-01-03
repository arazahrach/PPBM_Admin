<?php

namespace Database\Seeders;

use App\Models\Player;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PlayerSeeder extends Seeder
{
    public function run(): void
    {
        Player::truncate(); // hapus data lama (AMAN untuk dev)

        $names = [
            'joliejoie', 'brianngo', 'daviddo', 'henell', 'darrelbins',
            'sallykova', 'gugowski', 'leannon', 'mona', 'elrau',
            'putriva', 'astrmin', 'raka', 'bima', 'naufal',
            'rizky', 'alvin', 'yudha', 'tiara', 'ayu',
        ];

        foreach ($names as $i => $name) {
            Player::create([
                'account_name' => $name,
                'email' => $name . '@mail.com',
                'password_hash' => bcrypt('123456'),
                'rank' => rand(1, 3), // 1 bronze, 2 silver, 3 gold
                'status' => rand(0, 1) ? 'online' : 'offline',
                'in_lobby' => rand(0, 1),
                'score' => rand(5_000, 120_000),
                'total_visits' => rand(5, 50),
                'total_session_seconds' => rand(600, 7200),
                'last_active_at' => Carbon::now()->subMinutes(rand(1, 500)),
                'created_at' => Carbon::now()->subDays(rand(1, 60)),
            ]);
        }
    }
}
