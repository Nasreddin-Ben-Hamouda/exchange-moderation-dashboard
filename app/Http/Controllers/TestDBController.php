<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use App\Services\PostService;
//Classe de test qui permet de tester toutes nouvelles fonctionnalités developpée hors de son contexte 
// Conçu seulement pour des raisons de tests
class TestDBController extends Controller
{

    protected $postService;

    public function __construct(PostService $postService){
        $this->postService = $postService;
    } 
   
    public function test1(Request $req) {
        //return dd($this->postService->test());
        //return DB::table("users")->get();
        // $start_date = "06/04/1997";
        // $end_date="31/12/2021";
        // $query="SELECT * FROM users WHERE start_date > :start AND end_date < :end";
        // $bodytag = str_replace(":start", $start_date, $query);
        // $bodytag = str_replace(":end", $end_date, $bodytag);
        //  return dd($bodytag);
        // $query = Config::get('statistics_queries.GET_COUNTS_QUERY');
        //return DB::connection("mysql2")->select($query);
        //return DB::connection("mysql2")->table("users")->get();

        $start_date = "06/04/1997";
        $end_date="31/12/2021";
         //dd($this->postService->getNbrSignaledPostsAndProfiles($start_date,$end_date));
    }

    public function ajaxTest1(Request $request) {
        return $request->all();
    }

    public function ajaxView(){
        return view("test.test_ajax");
    }
}
