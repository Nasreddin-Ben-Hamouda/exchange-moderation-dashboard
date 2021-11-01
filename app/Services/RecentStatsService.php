<?php
namespace App\Services;

use App\Repositories\RecentStatsRepository;
/*
   Cette classe est une classe qui sera utilisée par la classe controleur correspondante 
   et elle utilise la classe repository correspondante,
   elle agit comme un classe intermédiaire entre les deux classes controleur et repository
   Cette classe se charge seulement à travers une seule méthode de
   retourner un tableau associatif aprés avoir formater le résultat d'invocation de a méthode 
   correspondante de la classe repository , ce tableau associatif contient 5 métriques statistiques
   (celles calculés sur les dernières 48 heures et qui sont affichées en haut de la page du tableau de bord)
*/
class RecentStatsService {
    protected $recentStatsRepo;

    public function __construct(RecentStatsRepository $recentStatsRepo){
      $this->recentStatsRepo = $recentStatsRepo;
    }


    public function getLast2DaysStats() {
        $start_date = now()->subDays(1)->format('Y-m-d');
        $end_date =  now()->format('Y-m-d');
        $res =[
            "NBR_SIGNALED_POSTS" => 0,
            "NBR_SIGNALED_PROFILES" => 0,
            "NBR_CREATED_TOPICS" => 0,
            "NBR_OPENED_SESSIONS" => 0,
            "NBR_SIGNALED_COMMENTS" =>0
        ];
        $tmp = $this->recentStatsRepo->getLast2DaysStats($start_date,$end_date);
        
        if(is_array($tmp) && !empty($tmp) && is_object($tmp[0])) {
          foreach($tmp[0] as $key=>$value){
            $res[$key] = $value;
          }
        }
        return $res;
    }
}