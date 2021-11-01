<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\BlogUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CommentSignalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersIds = BlogUser::where('id' ,'>' ,0)->pluck('id')->toArray();
        $commentsIds = Comment::where('id' ,'>' ,0)->pluck('id')->toArray();
        for($i=0;$i<57;$i++){
            DB::table("comment_signals")->insert([
             "user_id" => $usersIds[array_rand($usersIds)],
             "comment_id" => $commentsIds[array_rand($commentsIds)],
             "created_at" => now()->addSeconds($i)
            ]);
        }
    }
}
