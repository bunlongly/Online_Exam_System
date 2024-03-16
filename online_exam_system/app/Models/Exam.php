<?php

// app/Models/Exam.php

namespace App\Models;

use App\Models\User;
use App\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'course', 'duration'];

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'exam_question');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
