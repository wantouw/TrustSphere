<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $default_password = 'rian1234';
        User::insert([
            [
                'name' => 'Eldrian Daniswara Giovanni',
                'email' => 'eldrian.giovanni@binus.ac.id',
                'bio' => "Hello there! I am a Technology Enthusiast",
                'dob' => '2000-05-15',
                'profile_picture' => 'images/profile_pictures/7.jpeg',
                'role_id' => 1,
                'password' => Hash::make($default_password),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Alexandra Hamilton',
                'email' => 'alexandra.hamilton@example.com',
                'bio' => "Passionate about programming and data science.",
                'dob' => '1998-11-21',
                'role_id' => 1,
                'profile_picture' => 'images/profile_pictures/7.jpeg',
                'password' => Hash::make($default_password),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jordan Smith',
                'email' => 'jordan.smith@example.com',
                'bio' => "UI/UX Designer with a love for minimalism.",
                'dob' => '1995-02-10',
                'role_id' => 1,
                'profile_picture' => 'images/profile_pictures/7.jpeg',
                'password' => Hash::make($default_password),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Admin admin',
                'email' => 'admin@trustsphere.com',
                'bio' => "Admin Bro",
                'dob' => '1995-02-10',
                'role_id' => 2,
                'profile_picture' => 'images/profile_pictures/7.jpeg',
                'password' => Hash::make($default_password),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
