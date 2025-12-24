<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Ridho',
            'email' => 'ridhoendorse@gmail.com',
            'password' => Hash::make('admin'), 
            'email_verified_at' => null,
            'is_superadmin' => true,
            'is_notification' => true,
        ]);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'), 
            'is_superadmin' => true,
            'is_notification' => true,
            // 'email_verified_at' => null
        ]);

        User::factory()->create([
            'name' => 'Rafly',
            'email' => 'raflyistiadi27@gmail.com',
            'password' => Hash::make('password'), 
            'email_verified_at' => null,
            'is_superadmin' => true,
            'is_notification' => true,
        ]);
    }
}
