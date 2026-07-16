<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!User::where('email', 'admin@genesisindonesia.com')->exists()) {
            User::create([
                'name' => 'Admin Genesis',
                'email' => 'admin@genesisindonesia.com',
                'password' => Hash::make('Masyaallah@98#'),
                'email_verified_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        User::where('email', 'admin@genesisindonesia.com')->delete();
    }
};
