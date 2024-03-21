<?php

namespace Database\Seeders;

use App\Models\Question; 
use App\Models\User;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();

        if ($users->isEmpty()) {
            // Handle case where no users exist
            // You may want to create a user here or throw an error
        }

        // for ($i = 0; $i < 50; $i++) {
        //     $user = $users->random(); // Get a random user

        // Question::create([
        //     'user_id'      => $user->id, // Associate the question with this user
        //     'course'       => ['Software Requirement', 'Web development', 'Database System'][rand(0,2)],
        //     'question'     => 'This is a sample question ' . $i . 'generated by Faker.',
        //     'type'         => ['Multiple Choice', 'True or False', 'Enter the Answer'][rand(0, 2)],
        //     'difficulty'   => ['Easy', 'Hard', 'Medium'][rand(0, 2)], // Use rand(0, 2)
        //     'score'        => rand(30, 100),
        //     'correct_answer' => ['True', 'False', 'A', 'B', 'C', 'D', 'Python', 'Functional-requirement'][rand(0,7)],
        //     'options' => 'A: test 1, B: test 2, C: test 3, D: test 4',
        // ]);
        

        // }
    }
}
