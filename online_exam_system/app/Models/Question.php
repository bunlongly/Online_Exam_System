<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}

