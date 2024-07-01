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
            $table->integer('card_quantity')->after('card_decks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('game_settings', function (Blueprint $table) {
            $table->dropColumn('card_quantity');
        });
    }
};
