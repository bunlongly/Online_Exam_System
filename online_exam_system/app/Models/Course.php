<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    

//     public function courses()
// {
//     return $this->belongsToMany(Course::class);
// }


public function teachers()
{
    return $this->belongsToMany(User::class)->whereHas('roles', function ($query) {
        $query->where('name', 'teacher');
    });
}

public function students()
{
    return $this->belongsToMany(User::class)->whereHas('roles', function ($query) {
        $query->where('name', 'student');
    });
}


public function questions()
{
    return $this->hasMany(Question::class);
}



public function exams()
{
    return $this->hasMany(Exam::class);
}





}
