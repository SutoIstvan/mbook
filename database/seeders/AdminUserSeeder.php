<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
