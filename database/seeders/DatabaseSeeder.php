<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User directly (without factory/bcrypt to avoid double-hashing because of the User model's 'password' => 'hashed' cast)
        if (!User::where('email', 'admin@genesisindonesia.com')->exists()) {
            User::create([
                'name' => 'Admin Genesis',
                'email' => 'admin@genesisindonesia.com',
                'password' => 'Masyaallah@98#',
            ]);
        }
    }
}
