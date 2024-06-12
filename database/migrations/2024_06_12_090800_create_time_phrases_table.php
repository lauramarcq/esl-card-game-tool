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
        Schema::create('time_phrases', function (Blueprint $table) {
            $table->id();
            $table->string('time_phrase');
            $table->boolean('is_past')->default(true);
            $table->boolean('is_present')->default(true);
            $table->boolean('is_future')->default(true);
            $table->boolean('is_simple')->default(true);
            $table->boolean('is_perfect')->default(true);
            $table->boolean('is_continuous')->default(true);
            $table->boolean('is_perfect_continuous')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_phrase_level');
        Schema::dropIfExists('time_phrases');
    }
};
