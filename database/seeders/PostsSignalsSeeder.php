<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\BlogUser;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class PostsSignalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersIds = BlogUser::where('id' ,'>' ,0)->pluck('id')->toArray();
        $postsIds = Post::where('id' ,'>' ,0)->pluck('id')->toArray();
        for($i=0;$i<24;$i++){
            DB::table("post_signals")->insert([
             "user_id" => $usersIds[array_rand($usersIds)],
             "post_id" => $postsIds[array_rand($postsIds)],
             "created_at" => now()->addSeconds($i)
            ]);
         }
    }
}
