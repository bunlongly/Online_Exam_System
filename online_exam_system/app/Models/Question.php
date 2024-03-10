<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    // Define the fillable fields
    protected $fillable = ['course', 'question', 'type', 'difficulty', 'score', 'correct_answer'];


}
