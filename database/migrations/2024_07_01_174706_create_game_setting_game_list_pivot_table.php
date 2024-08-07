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
        Schema::create('game_list_game_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_settings_id')->constrained()->onDelete('cascade');
            $table->foreignId('game_list_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('game_list_game_settings', function (Blueprint $table) {
            $table->dropForeign(['game_settings_id']);
            $table->dropForeign(['game_list_id']);
        });
        Schema::dropIfExists('game_list_game_settings');
    }
};
