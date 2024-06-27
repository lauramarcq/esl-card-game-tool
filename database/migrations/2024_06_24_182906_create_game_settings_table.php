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
        Schema::create('game_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id')->references('id')->on('games')->onDelete('cascade');
            $table->foreignId('level_id')->references('id')->on('levels')->onDelete('cascade');
            $table->integer('card_decks');
            $table->foreignId('deck_1_category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreignId('deck_2_category_id')->nullable()->references('id')->on('categories')->onDelete('cascade');
            $table->foreignId('deck_3_category_id')->nullable()->references('id')->on('categories')->onDelete('cascade');
            $table->foreignId('deck_1_list_id')->references('id')->on('game_lists')->onDelete('cascade');
            $table->foreignId('deck_2_list_id')->nullable()->references('id')->on('game_lists')->onDelete('cascade');
            $table->foreignId('deck_3_list_id')->nullable()->references('id')->on('game_lists')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('game_settings', function (Blueprint $table) {
            $table->dropForeign(['deck_1_category_id']);
            $table->dropForeign(['deck_2_category_id']);
            $table->dropForeign(['deck_3_category_id']);
            $table->dropForeign(['deck_1_list_id']);
            $table->dropForeign(['deck_2_list_id']);
            $table->dropForeign(['deck_3_list_id']);
            $table->dropForeign(['game_id']);
            $table->dropForeign(['level_id']);
        });
            
        Schema::dropIfExists('game_settings');
    }
};
