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
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
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
    // First, drop the pivot table
    Schema::dropIfExists('exam_question');

    // Then, drop the exams table
    Schema::dropIfExists('exams');
    }
};
