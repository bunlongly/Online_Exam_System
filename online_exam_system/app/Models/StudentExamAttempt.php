<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentExamAttempt extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'exam_id', 'attempted_at'];
    
}
