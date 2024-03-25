<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            $table->string('title');
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->integer('duration'); // in minutes
            $table->boolean('published')->default(false);
            $table->timestamp('start_time')->nullable(); // Add start time
            $table->timestamp('end_time')->nullable(); // Add end time
            $table->timestamps();
        });

        // Create a pivot table for exams and questions
        Schema::create('exam_question', function (Blueprint $table) {
            $table->foreignId('exam_id')->constrained()->onDelete('cascade');
            $table->foreignId('question_id')->constrained()->onDelete('cascade');
            $table->primary(['exam_id', 'question_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exam_question');
        Schema::dropIfExists('exams');
    }
};
