<?php
namespace Database\Seeders;

use Database\Factories\PostFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            BlogUserSeeder::class,
            PostSeeder::class,
            PostsSignalsSeeder::class,
            SessionSeeder::class,
            TopicSeeder::class,
            PostTopicSeeder::class,
            CommentSeeder::class,
            WeightVoteSeeder::class,
            CommentSignalsSeeder::class,
            UsersSignalsSeeder::class
            //other seeders here with order ---> but , we want ids from 
            //previous seeders executions to use them in relationships establishments 
        ]);
    }
}
