<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Delete existing admin user to prevent duplicates or corrupted password hashes
        User::where('email', 'admin@genesisindonesia.com')->delete();

        // Create the admin user with clean password hashing (single encryption)
        User::create([
            'name' => 'Admin Genesis',
            'email' => 'admin@genesisindonesia.com',
            'password' => 'Masyaallah@98#',
        ]);
    }
}
