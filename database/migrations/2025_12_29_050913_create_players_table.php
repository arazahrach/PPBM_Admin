<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();

            $table->string('account_name', 20)->unique();
            $table->string('email')->unique();

            // password disimpan hash
            $table->string('password_hash');

            // foto profil: simpan path (mis: "profiles/abc.png") atau url
            $table->string('profile_photo')->nullable();

            // rank: 1 bronze, 2 silver, 3 gold, dst
            $table->unsignedTinyInteger('rank')->default(1);

            // status online/offline
            $table->enum('status', ['online', 'offline'])->default('offline');

            // lobby boolean
            $table->boolean('in_lobby')->default(false);

            // score leaderboard
            $table->unsignedInteger('score')->default(0);

            $table->timestamps();

            $table->index(['score', 'rank']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
