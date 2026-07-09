<?php

namespace Database\Seeders;

use App\Models\{
    User,
    UserPermission,
};

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
            'position' => 'Super Administrator',
            'role_id' => 1,
            'email' => 'superadmin@example.com',
            'username' => 'superadmin',
            'password' => Hash::make('superadmin'), // Always hash the password!
        ]);
    }
}