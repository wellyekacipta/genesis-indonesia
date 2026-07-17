<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Delete existing admin user to prevent duplicates
        User::where('email', 'admin@genesisindonesia.com')->delete();

        // Create the admin user with explicit Hash::make to ensure it is always hashed properly in the database
        User::create([
            'name' => 'Admin Genesis',
            'email' => 'admin@genesisindonesia.com',
            'password' => Hash::make('Masyaallah@98#'),
        ]);
    }
}
