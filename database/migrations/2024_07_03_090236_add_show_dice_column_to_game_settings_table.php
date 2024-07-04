<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('game_settings', function (Blueprint $table) {
            $table->boolean('show_dice')->after('show_timer')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('game_settings', function (Blueprint $table) {
            $table->dropColumn('show_dice');
        });
    }
};
