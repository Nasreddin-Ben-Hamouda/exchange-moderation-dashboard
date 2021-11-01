<?php
namespace App\Repositories;
use App\Models\Post;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
/*
  Classe responsable d'intéragir directement avec la BD pour fournir des données/métrique statistiques relatives aux postes
  ses méthodes sont invoquées par les classes services correspondantes
*/
class PostRepository  {


  /*
      Cette méthode  (utilise la socket de connexion mysql2 car les données relatifs au blog sont accessibles par cette instance de socket connexion)
      permet de récuperer les derniers postes signalés (par date de signal)
  */
  public function getLastNSignaledPosts(int $n = 5) {
     $result = DB::table('posts as p')
               ->select("p.*","tmpTab.last_signal_date","tmpTab.nbr_of_signals","bu.firstname  AS user_firstname",
                        "bu.lastname AS user_lastname")
               ->join(DB::raw(
                   "(SELECT ps.post_id ,MAX(ps.created_at) AS last_signal_date,
                   COUNT(*) AS nbr_of_signals FROM post_signals ps GROUP BY ps.post_id
                   ORDER BY last_signal_date DESC) tmpTab "),function($join){
                           $join->on("p.id","=","tmpTab.post_id");
                }
              )->join("blog_users as bu","p.user_id","=","bu.id")
               ->orderBy("last_signal_date","desc");

    return $result;
  }

}
?>
