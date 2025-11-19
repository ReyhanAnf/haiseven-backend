<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a demo user
        User::updateOrCreate(
            ['email' => 'demo@haiseven.com'],
            [
                'name' => 'Demo User',
                // Password will be hashed via User model cast
                'password' => 'password',
            ]
        );

        User::updateOrCreate(
            ['email' => 'admin@haiseven.com'],
            [
                'name' => 'Admin User',
                // Password will be hashed via User model cast
                'password' => 'password',
                'is_admin' => true,
            ]
        );
    }
}
