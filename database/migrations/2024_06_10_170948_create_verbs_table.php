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
        Schema::create('verbs', function (Blueprint $table) {
            $table->id();
            $table->string('infinitive');
            $table->boolean('is_irregular')->default(false);
            $table->boolean('is_intransitive')->default(false);
            $table->boolean('is_modal_verb')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verbs');
    }
};
