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
        Schema::create('nouns', function (Blueprint $table) {
            $table->id();
            $table->string('noun');
            $table->boolean('is_plural')->default(false);
            $table->boolean('is_irregular')->default(false);
            $table->boolean('ends_in_y')->default(false);
            $table->boolean('ends_in_s_sh_ch')->default(false);
            $table->boolean('ends_in_f')->default(false);
            $table->boolean('begins_with_vowel_sound')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nouns');
    }
};
