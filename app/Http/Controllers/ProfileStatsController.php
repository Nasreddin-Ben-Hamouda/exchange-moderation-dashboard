<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use  App\Services\BlogUserService;
use App\Models\BlogUserSignal;
use App\Models\BlogUser;

/*
 Ce Controleur http se charge de servir des fonctions en relation avec les utilisateurs du blog (les internautes)
*/
class ProfileStatsController extends Controller
{

    protected $blogUserService;

    public function __construct(BlogUserService $blogUserService){
        $this->middleware("auth");
        $this->blogUserService = $blogUserService;
    }

    /*
      Cette méthode se charge d'afficher tous les profils utilisateurs signalés avec une pagination de 10 résultats par page
    */
    public function getLast5SignaledProfiles(Request $req){
      return view("profile.signaled_profiles")
      ->with("data",$this->blogUserService->getLastNSignaledBlogUsers()->cursorPaginate(10));
    }

     /*
      Cette méthode se charge d'afficher tous les profils utilisateurs en liste noire: c'est a dire les profils utilisateurs qui ont subis un nombe de signal >=
      au seuil préfixé et durant l' intervalle temporelle choisi sur l'interface utilisateur UI
    */
    public function getBlacklistedProfiles(Request $req){
      $threshold = 1;
      $from_date = '1970-01-01';
      $to_date = now()->format('Y-m-d');

      $req->validate([
        'threshold' => 'sometimes|nullable|numeric',
        'from-date' => 'sometimes|nullable|date_format:Y-m-d',
        'to-date' => 'sometimes|nullable|date_format:Y-m-d'
      ]);

      
      if($req->has("threshold") || $req->has("from-date") || $req->has("to-date")) {
           $threshold = $req->query('threshold') ?? 5;
           $from_date = !empty($req->query('from-date')) ? $req->query('from-date') : $from_date;
           $to_date = !empty($req->query('to-date')) ? $req->query('to-date') : $to_date;
      }

      $data = $this->blogUserService->getBlacklistedProfiles($threshold,$from_date,$to_date)->simplePaginate(10);
      
      return view("profile.blacklisted_profiles")
              ->with("data",$data,)
              ->with("threshold",$threshold)
              ->with("from",$from_date)
              ->with("to",$to_date);
    }



    /*
      Cette méthode se charge d'afficher toutes les causes de signals subis par un utilisateurs : 
      Une cause de signal pourrait etre la publication d'un poste OU la publication d'un commentaire jugés inappropriés
    */
    public function getSignalsContextsForUser(Request $req,$id){    
      $signals = BlogUserSignal::where("signaled_id","=",$id)->orderBy("created_at","desc")->with(["signalerUser"])->cursorPaginate(10);

      return view("profile.show_user_associated_signals_with_context")
      ->with("signals",$signals->appends($req->except('page')))
      ->with("id",$id)
      ->with("fullname",$req->query("fullname"));
    }

     /*
      Cette méthode se charge d'afficher les informations relatives à un utilisateur donné
    */
    public function show($id){
      return view("profile.show_one")->with("profile",BlogUser::findOrFail($id));
    }
}
