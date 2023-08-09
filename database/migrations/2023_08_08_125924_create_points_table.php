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
        Schema::create('points', function (Blueprint $table) {
            $table->id();
            $table->integer('point');

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('academic_discipline_id');

            $table->foreign('user_id')->references('id')->on('users')->OnDelete('cascade');
            $table->foreign('academic_discipline_id')->references('id')->on('academic_disciplines')->OnDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('points');
    }
};
