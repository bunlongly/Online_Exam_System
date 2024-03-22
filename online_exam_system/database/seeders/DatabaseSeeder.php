<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        {
    // User::factory(5)->create();
        // No need for 'use Database\Seeders\QuestionSeeder;' since it's the same namespace
        // $this->call(QuestionSeeder::class);
        $this->call([
            RolesTableSeeder::class,
            AdminUserSeeder::class,
        ]);
    }
}
}
