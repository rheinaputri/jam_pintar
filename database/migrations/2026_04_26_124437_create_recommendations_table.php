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
        Schema::create('recommendations', function (Blueprint $table) {
            $table->id();
            $table->enum('chronotype', ['lion', 'bear', 'wolf', 'dolphin']);
            $table->text('recomendation');
            $table->time('study_hour_start');
            $table->time('study_hour_end');
            $table->time('alt_study_hour_start')->nullable();
            $table->time('alt_study_hour_end')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recommendations');
    }
};
