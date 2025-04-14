<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'alisa',
            'email' => 'alisa@gmail.com',
            'password' => Hash::make('password123'),
        ]);
        User::create([
            'name' => 'normalinda',
            'email' => 'norma@gmail.com',
            'password' => Hash::make('password123'),
        ]);
        User::create([
            'name' => 'anwar',
            'email' => 'jokoanwar@gmail.com',
            'password' => Hash::make('password123'),
        ]);
    }
}
