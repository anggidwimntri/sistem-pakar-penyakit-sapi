<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Membuat akun admin default
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@dinas.com',
            'password' => Hash::make('admin123'), // Password default: admin123
        ]);
    }
}