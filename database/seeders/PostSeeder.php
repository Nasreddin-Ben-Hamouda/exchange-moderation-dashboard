<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\BlogUser;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::factory()->count(30)->create();
    }
}
