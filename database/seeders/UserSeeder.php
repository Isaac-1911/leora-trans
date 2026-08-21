<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Leona',
            'email' => 'admin@leonitrans.web.id',
            'password' => Hash::make('leonip'),
            'role' => 'admin',
        ]);
    }
}
