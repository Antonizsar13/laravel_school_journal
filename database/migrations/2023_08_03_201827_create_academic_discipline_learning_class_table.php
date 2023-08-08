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
        Schema::create('a_discipline_l_class', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('academic_discipline_id');
            $table->unsignedBigInteger('learning_class_id');

            $table->foreign('academic_discipline_id')->references('id')->on('academic_disciplines');
            $table->foreign('learning_class_id')->references('id')->on('learning_classes');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('a_discipline_l_class');
    }
};
