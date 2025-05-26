<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        DB::table('admin_users')->insert([
            'name' => 'xpansea',
            'public_name' => 'admXp',
            'email' => 'admin@xpanse.com',
            'password' => Hash::make('1234'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(24),
        ]);
        DB::table('front_users')->insert([
            'name' => 'xpansef',
            'public_name' => 'fntXp',
            'email' => 'front@xpanse.com',
            'password' => Hash::make('1234'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(24),
        ]);
        DB::table('managers')->insert([
            'name' => 'xpansem',
            'public_name' => 'mngXp',
            'email' => 'manager@xpanse.com',
            'password' => Hash::make('1234'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(24),
        ]);

    }
}
