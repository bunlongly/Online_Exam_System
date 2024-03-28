<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'course_id', 'duration', 'published', 'start_time', 'end_time' ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'exam_question');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
    public function publisher()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function student() {
        return $this->belongsTo(User::class, 'student_id');
    }


    public function exam() {
        return $this->belongsTo(Exam::class);
    }

    public function courseTeachers()
    {
    return $this->course->teachers(); 
    }


}

