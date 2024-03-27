<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamAttempt extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'exam_id', 'score', 'passed', 'attempt_date'];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function exam()
    {
        // Assuming the foreign key in the 'exam_attempts' table is 'exam_id'
        // and the primary key in the 'exams' table is 'id'.
        return $this->belongsTo(Exam::class, 'exam_id');
    }
}
