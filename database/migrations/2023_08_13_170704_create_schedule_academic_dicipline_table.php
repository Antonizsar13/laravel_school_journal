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
        Schema::create('schedule_academic_dicipline', function (Blueprint $table) {
            $table->id();

            $table->integer('number');

            $table->unsignedBigInteger('academic_discipline_id');
            $table->unsignedBigInteger('schedule_id');

            $table->foreign('academic_discipline_id')->references('id')->on('academic_disciplines')->OnDelete('cascade');
            $table->foreign('schedule_id')->references('id')->on('schedules')->OnDelete('cascade');

            $table->unique(['schedule_id', 'number']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule_academic_dicipline');
    }
};
