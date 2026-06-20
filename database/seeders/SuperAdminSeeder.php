<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'last_name' => 'Admin',
            'first_name' => 'Super',
            'middle_name' => '',
            'role' => 1,
            'email' => 'superadmin@example.com',
            'password' => Hash::make('superadmin'), // Always hash the password!
        ]);
    }
}