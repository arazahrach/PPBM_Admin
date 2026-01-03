<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('players', function (Blueprint $table) {
            $table->unsignedInteger('total_visits')->default(0)->after('score');
            $table->unsignedInteger('total_session_seconds')->default(0)->after('total_visits');
            $table->timestamp('last_active_at')->nullable()->after('total_session_seconds');

            $table->index('last_active_at');
        });
    }

    public function down(): void
    {
        Schema::table('players', function (Blueprint $table) {
            $table->dropIndex(['last_active_at']);
            $table->dropColumn(['total_visits', 'total_session_seconds', 'last_active_at']);
        });
    }
};

