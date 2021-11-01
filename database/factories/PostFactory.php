<?php

namespace Database\Factories;

use App\Models\BlogUser;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;
    private static $usersIds=null;
    private static $i=0;

    private function init(){
       if($this::$usersIds == null){
           $this::$usersIds = BlogUser::where('id' ,'>' ,0)->pluck('id')->toArray();
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
        //shuffle($this::$usersIds);
        return [
            "title"=>$this->faker->sentence(3),
            "content"=>$this->faker->paragraph(15),
            "created_at"=>now()->addSeconds($this::$i++),
            "user_id"=> $this::$usersIds[array_rand($this::$usersIds)]
        ];
    }
}
