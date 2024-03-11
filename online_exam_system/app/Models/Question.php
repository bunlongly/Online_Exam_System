<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['course', 'question', 'type', 'difficulty', 'score', 'correct_answer', 'options'];

    protected $casts = [
        'options' => 'array', // Only needed if you're using a JSON column
    ];
}
