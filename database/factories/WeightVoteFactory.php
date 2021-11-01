<?php

namespace Database\Factories;

use App\Models\WeightVote;
use App\Models\BlogUser;
use App\Models\Post;

use Illuminate\Database\Eloquent\Factories\Factory;

class WeightVoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WeightVote::class;
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
           "post_id"=>$this::$postsIds[array_rand($this::$postsIds)],
           "user_id"=>$this::$usersIds[array_rand($this::$usersIds)],
           "voted_on" => now()->addSeconds($this::$i++)
        ];
    }
}
