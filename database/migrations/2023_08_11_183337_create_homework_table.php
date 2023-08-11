<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('homework', function (Blueprint $table) {
            $table->id();

            $table->string('task');
            $table->dateTime('date')->default(DB::raw('CURRENT_TIMESTAMP'));

            
            $table->unsignedBigInteger('learning_class_id');
            $table->unsignedBigInteger('academic_discipline_id');

            $table->foreign('learning_class_id')->references('id')->on('learning_classes')->OnDelete('cascade');
            $table->foreign('academic_discipline_id')->references('id')->on('academic_disciplines')->OnDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homework');
    }
};
