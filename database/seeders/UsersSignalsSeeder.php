<?php

namespace Database\Seeders;

use App\Models\BlogUser;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSignalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersIds = BlogUser::where('id' ,'>' ,0)->pluck('id')->toArray();
        for($i=0;$i<54;$i++){
            $res =  ($i % 2 == 0) ? Post::factory()->create() : Comment::factory()->create();
            DB::table("user_signals")->insert([
            "user_id" => $usersIds[array_rand($usersIds)],
            "signaled_id" => $res->user_id,
            "context_id"=> $res->id,
            "context_type"=> ($i % 2 == 0) ? "App\Models\Post" : "App\Models\Comment",
            "created_at" => now()->addSeconds($i)
           ]);
        }
    }
}
