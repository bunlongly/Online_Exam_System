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
         Schema::create('exams', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('course');
        $table->integer('duration'); // in minutes
        $table->timestamps();
    });

    // Create a pivot table for exams and questions if it doesn't exist yet
    Schema::create('exam_question', function (Blueprint $table) {
        $table->foreignId('exam_id')->constrained()->onDelete('cascade');
        $table->foreignId('question_id')->constrained()->onDelete('cascade');
        $table->primary(['exam_id', 'question_id']);
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
