<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use App\Models\Topic;
use App\Models\Post;
use Illuminate\Database\Seeder;

class PostTopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $topicsIds = Topic::where('id' ,'>' ,0)->pluck('id')->toArray();
        $postsIds = Post::where('id' ,'>' ,0)->pluck('id')->toArray();
        for($i=0;$i<68;$i++){
            DB::table("post_topic")->insert([
             "topic_id" => $topicsIds[array_rand($topicsIds)],
             "post_id" => $postsIds[array_rand($postsIds)],
             "created_at" => now()->addSeconds($i)
            ]);
         }
    }
}
