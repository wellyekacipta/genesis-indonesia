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
        // Create Admin User directly (without factory to avoid Faker errors in production)
        if (!User::where('email', 'admin@genesisindonesia.com')->exists()) {
            User::create([
                'name' => 'Admin Genesis',
                'email' => 'admin@genesisindonesia.com',
                'password' => bcrypt('Masyaallah@98#'),
            ]);
        }
    }
}
