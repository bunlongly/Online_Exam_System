<?php


namespace App\Models;

use App\Models\Exam;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['course', 'question', 'type', 'difficulty', 'score', 'correct_answer', 'options', 'user_id'];

    protected $casts = [
        'options' => 'array',
    ];

    // Add this method
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function exams()
    {
        return $this->belongsToMany(Exam::class, 'exam_question');
    }

}

