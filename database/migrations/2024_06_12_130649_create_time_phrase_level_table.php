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
        Schema::create('time_phrase_level', function (Blueprint $table) {
            $table->id();
            $table->foreignId('time_phrase_id')->references('id')->on('time_phrases')->onDelete('cascade')->onUpdate('cascade');
            $table->string('level_id');
            $table->foreign('level_id')->references('code')->on('levels')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('time_phrase_level', function (Blueprint $table) {
            $table->dropForeign(['time_phrase_id']);
            $table->dropForeign(['level_id']);
        });

        Schema::dropIfExists('time_phrase_level');
    }
};
