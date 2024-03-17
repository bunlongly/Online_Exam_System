<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'course', 'duration', 'published' ];

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'exam_question');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

