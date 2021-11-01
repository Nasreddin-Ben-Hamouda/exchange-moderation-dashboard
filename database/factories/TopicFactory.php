<?php

namespace Database\Factories;

use App\Models\Topic;
use App\Models\BlogUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class TopicFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Topic::class;
    private static $i=0;

    private static $usersIds=null;
   

    private function init(){
       if($this::$usersIds == null){
           $this::$usersIds = BlogUser::where('id' ,'>' ,0)->pluck('id')->toArray();
           error_log('******************************** HERE TH INIT EXECUTION ********************************');
       }
    }

    private static $topicsLabels = [
        "TENDANCES TECH",
        "ELECTONIQUE",
        "AI",
        "NUMERIQUE",
        "SMARTPHONES",
        "PC",
        "JEUX",
        "FILMS",
        "SERIES TV",
        "BLACK FRIDAY",
        "OFFRES LIMITÉS"
    ];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(){
        $this->init();
        return [
           "label" => $this::$topicsLabels[array_rand($this::$topicsLabels)],
           "created_at" => now()->addSeconds($this::$i++),
           "created_by"=> $this::$usersIds[array_rand($this::$usersIds)]
        ];
    }
}
