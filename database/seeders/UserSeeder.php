<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name'              => 'Admin',
                'email'             => 'admin@example.com',
                'password'          => Hash::make('password'),
                'profile_img'       => null,
                'city'              => 'jakarta',
                'birth_date'        => '1990-01-01',
                'gender'            => 'LakiLaki',
                'role'              => 'admin',
                'email_verified_at' => now(),
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'              => 'Budi Santoso',
                'email'             => 'budi@example.com',
                'password'          => Hash::make('password'),
                'profile_img'       => null,
                'city'              => 'surabaya',
                'birth_date'        => '2002-05-15',
                'gender'            => 'LakiLaki',
                'role'              => 'user',
                'email_verified_at' => now(),
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
        ]);
    }
}
