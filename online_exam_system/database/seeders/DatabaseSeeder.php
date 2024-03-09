<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // No need for 'use Database\Seeders\QuestionSeeder;' since it's the same namespace
        $this->call(QuestionSeeder::class);
    }
}
