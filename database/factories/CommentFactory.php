<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\BlogUser;
use App\Models\Post;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;
    private static $usersIds=null;
    private static $postsIds=null;
    private static $i=0;

    private function init(){
       if($this::$usersIds == null && $this::$postsIds == null){
           $this::$usersIds = BlogUser::where('id' ,'>' ,0)->pluck('id')->toArray();
           $this::$postsIds = Post::where('id' ,'>' ,0)->pluck('id')->toArray();
           error_log('******************************** HERE TH INIT EXECUTION ********************************');
       }
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->init();
        return [
           "content"=>$this->faker->paragraph(10),
           "post_id"=>$this::$postsIds[array_rand($this::$postsIds)],
           "user_id"=>$this::$usersIds[array_rand($this::$usersIds)],
           "created_at" => now()->addSeconds($this::$i++)
        ];
    }
}
