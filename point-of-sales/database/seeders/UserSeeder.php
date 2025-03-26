<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // eloquent
        // raw query
        // db
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => '12345678',
        ]);

    }
}
