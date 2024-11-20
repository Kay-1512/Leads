<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'first_name' => 'Michaela',
            'last_name' => 'McRowdie',
            'email' => 'michaela@connecthr.co.za',
            'email_verified_at' => now(),
            'phone' => '3',
            'password' => bcrypt('June1676!'),
            'remember_token' => Str::random(10)
        ]);

        $user->assignRole('Admin');

        $user = User::create([
            'first_name' => 'Anna',
            'last_name' => 'Mupariwa',
            'email' => 'anna@connecthr.co.za',
            'email_verified_at' => now(),
            'phone' => '1',
            'password' => bcrypt('June1676!'),
            'remember_token' => Str::random(10)
        ]);

        $user->assignRole('Admin');

        $user = User::create([
            'first_name' => 'Floyd',
            'last_name' => 'Mazibuko',
            'email' => 'floyd@skillspanda.co.za',
            'phone' => '2',
            'email_verified_at' => now(),
            'password' => bcrypt('June1676!'),
            'remember_token' => Str::random(10)
        ]);

        $user->assignRole('Admin');
    }
}
