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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->boolean('is_plural')->default(false);
            $table->boolean('begins_with_article_a')->default(false);
            $table->boolean('begins_with_article_an')->default(false);
            $table->boolean('begins_with_article_the')->default(false);
            $table->boolean('is_people')->default(false);
            $table->boolean('is_animal')->default(false);
            $table->boolean('is_place')->default(false);
            $table->boolean('is_thing')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_level');
        Schema::dropIfExists('subjects');
    }
};
