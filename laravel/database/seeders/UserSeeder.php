<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{

    private const DEFAULT_ADMIN_EMAIL= 'r@r.r';
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Default Admin',
            'email' => self::DEFAULT_ADMIN_EMAIL,
            'email_verified_at' => now(),
            'password' => Hash::make('11111111'),
            'remember_token' => Str::random(10),
            'activated_at' => now(),
        ]);

        User::factory()->count(10)->create([
            'activated_at' => now(),
        ]);

        User::factory()->count(30)->create();
    }
}
