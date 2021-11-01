<?php
namespace App\Repositories;
use Illuminate\Support\Facades\DB;

/*
  Classe responsable d'intéragir directement avec la BD pour fournir des données/métrique statistiques relatives aux utilisateurs du blog
  ses méthodes sont invoquées par les classes services correspondantes
  */
class BlogUserRepository {

  /*
    Cette méthode  (utilise la socket de connexion mysql2 car les données relatifs au blog sont accessibles par cette instance de socket connexion)
      permet de récuperer les derniers utiisateurs signalés (par date de signal)
  */
  public function getLastNSignaledBlogUsers(int $n= 5) {
    $result = DB::table("blog_users as bu")
              ->select("bu.*","tmpTab.last_signal_date","tmpTab.nbr_of_signals")
              ->join(DB::raw("
                        (SELECT us.signaled_id ,MAX(us.created_at) AS last_signal_date ,
                        COUNT(*) AS nbr_of_signals FROM user_signals us GROUP BY us.signaled_id
                        ORDER BY last_signal_date DESC) tmpTab
             "),function($join){
                  $join->on("bu.id","=","tmpTab.signaled_id");
              }
             )->orderBy("last_signal_date","desc");
    return $result;
  }

  /*
    Cette méthode permet de récuperer les derniers utilisateurs signalés (par date de signal)
  */
  public function getBlacklistedProfiles($threshold,$from,$to){
     return DB::table("blog_users as bu")
            ->select("bu.*",DB::raw("COUNT(*) as nbr_of_signals"))
            ->join("user_signals as us",function($join) use($to,$from){
               $join->on("bu.id","=","us.signaled_id");
            })->whereDate("us.created_at",">=",$from)
              ->whereDate("us.created_at","<=",$to)
              ->groupBy("bu.id")
              ->having("nbr_of_signals",">=",$threshold)
              ->orderBy("nbr_of_signals","desc");
  }


}
