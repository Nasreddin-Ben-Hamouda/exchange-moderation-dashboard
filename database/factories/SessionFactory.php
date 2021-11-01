<?php

namespace Database\Factories;

use App\Models\Session;
use App\Models\BlogUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class SessionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Session::class;
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
        return [
            "opened_on"=>now()->addSeconds($this::$i++),
            "user_id"=> $this::$usersIds[array_rand($this::$usersIds)]
        ];
    }
}
