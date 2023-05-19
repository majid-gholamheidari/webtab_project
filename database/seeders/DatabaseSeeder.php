<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Seeders\Dashboard\AdminSeeder;
use Database\Seeders\Dashboard\CommentSeeder;
use Database\Seeders\Dashboard\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AdminSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CommentSeeder::class);
    }
}
