<?php
namespace App\Repositories;
use Illuminate\Support\Facades\DB;
/*
  Classe responsable d'intéragir directement avec la BD pour fournir des données/métrique statistiques relatives aux commentaires
  ses méthodes sont invoquées par les classes services correspondantes
*/
class CommentRepository {
   /*
    Cette méthode  (utilise la socket de connexion mysql2 car les données relatifs au blog sont accessibles par cette instance de socket connexion)
      permet de récuperer les derniers commentaires signalés (par date de signal)
  */
   public function getLastNSignaledComments(int $n= 5) {
      $result = DB::table('comments as c')
        ->select("c.*","tmpTab.last_signal_date","tmpTab.nbr_of_signals","bu.firstname  AS user_firstname",
                "bu.lastname AS user_lastname")
        ->join(DB::raw(
            "(SELECT cs.comment_id ,MAX(cs.created_at) AS last_signal_date,
            COUNT(*) AS nbr_of_signals FROM comment_signals cs GROUP BY cs.comment_id
            ORDER BY last_signal_date DESC) tmpTab "),function($join){
                    $join->on("c.id","=","tmpTab.comment_id");
        }
    )->join("blog_users as bu","c.user_id","=","bu.id")
        ->orderBy("last_signal_date","desc");

     return $result;
   }
}

