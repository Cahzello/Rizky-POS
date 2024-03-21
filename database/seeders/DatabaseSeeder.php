<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Customer;
use App\Models\Categories;
use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'username' => 'rizky',
            'email' => 'cahzello@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);
        User::create([
            'username' => 'miku',
            'email' => 'miku@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'user',
            'path_file' => 'avatars/Zc21WZwZNHQEQQARJRUFzEdKClrXYcYnm2G9e9vJ.png'
        ]);
        User::factory(3)->create();
        Categories::factory(20)->create();
        Customer::factory(20)->create();
        Item::factory(20)->create();
    }
}
