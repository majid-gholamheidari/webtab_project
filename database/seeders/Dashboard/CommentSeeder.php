<?php

namespace Database\Seeders\Dashboard;

use App\Models\Admin;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Comment::where('admin_id', null)->count() < 200) {
            for ($i = 1; $i <= 200; $i++) {
                $data = [
                    'user_id' => User::inRandomOrder()->first()->id,
                    'admin_id' => null,
                    'parent_id' => rand(0, 1)
                        ? (Comment::where('status', config('constants.comments.status.accepted'))->inRandomOrder()->first()->id ?? null)
                        : null,
                    'status' => rand(0, 1),
                    'text' => implode(' ', fake()->sentences(rand(3, 10)))
                ];
                Comment::create($data);
            }
        }
    }
}
