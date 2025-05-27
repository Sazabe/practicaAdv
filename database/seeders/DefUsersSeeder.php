<?php

namespace Database\Seeders;

use App\Models\AdminUser;
use App\Models\FrontUser;
use App\Models\Manager;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DefUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('1234'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(24),
        ]);

        $admin = AdminUser::create([
            'name' => 'admXp',
            'public_name' => 'admXp',
            'email' => 'admin@xpanse.com',
            'password' => Hash::make('1234'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(24),
        ]);

        Manager::create([
            'name' => 'xpansem',
            'public_name' => 'mngXp',
            'email' => 'manager@xpanse.com',
            'admin_user_id' => $admin->id,
            'password' => Hash::make('1234'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(24),
        ]);

        FrontUser::create([
            'name' => 'xpansef',
            'public_name' => 'fntXp',
            'email' => 'front@xpanse.com',
            'password' => Hash::make('1234'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(24),
        ]);
    }
}
