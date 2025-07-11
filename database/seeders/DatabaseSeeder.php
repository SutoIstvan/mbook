<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::updateOrCreate(
            ['email' => 'info@rememus.com'],
            [
                'name' => 'Admin',
                'email' => 'info@rememus.com',
                'password' => Hash::make('ivc4Y2VKcLzcyp7'),
                'role' => 'admin',
            ]
        );
    }
}
