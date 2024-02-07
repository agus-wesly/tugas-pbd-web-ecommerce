<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => "Administrator",
            'username' => 'admin123',
            'role' => 'admin',
            'email' => 'admin@gmail.com' ,
            'password' => '$2y$12$AOHhCW8rLp37VRMGkqYw6.x9pB1dZ8hTyTYdjbLLCwDFe/BNf74mO',
            'profile_url' => '/profile.jpeg'
          ]);
    }
}
