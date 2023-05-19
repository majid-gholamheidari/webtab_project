<?php

namespace Database\Seeders\Dashboard;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::firstOrCreate(['email' => 'admin@webtab.com'], [
            'name' => 'Admin God',
            'email' => 'admin@webtab.com',
            'password' => Hash::make('admin@webtab.com')
        ]);
    }
}
