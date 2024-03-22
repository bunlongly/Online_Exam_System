<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        $adminRole = Role::where('name', 'admin')->first();

        $uniqueID = 'A' . mt_rand(100000, 999999);

        $admin = User::create([
            'unique_id' => $uniqueID,
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@example.com',
            'phone' => '011318338', 
            'password' => bcrypt('123456'),  
            'date_of_birth' => '1970-01-01',
             ]);
        $admin->roles()->attach($adminRole);
    }
}
