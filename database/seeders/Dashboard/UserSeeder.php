<?php

namespace Database\Seeders\Dashboard;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class UserSeeder extends Seeder
{
    use WithoutModelEvents
    ;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (User::count() < 50) {
            User::factory()->count((50 - User::count()))->create();
        }
    }
}
