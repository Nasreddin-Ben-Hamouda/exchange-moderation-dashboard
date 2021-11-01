<?php

namespace App\Services;
use App\Repositories\Last7DaysStatsRepository;
/*
   Cette classe est une classe qui sera utilisée par la classe controleur correspondante (l' AjaxDashbaordChartStatsController)
   et elle utilise la classe repository correspondante,
   elle agit comme un classe intermédiaire entre les deux classes controleur et repository
   Cette classe se charge principalement du formatage du résultat retourné par la méthode correspondate 
   de class repository utilisée
*/
class Last7DaysStatsService {

    protected $last7DaysStatsRepo;
    
    public function __construct(Last7DaysStatsRepository $last7DaysStatsRepo){
      $this->last7DaysStatsRepo = $last7DaysStatsRepo;
    }

    /*
      Cette méthode se charge de récupérer les données retournés de la BD à travers l'invocation de la méthode 
      correspondante de la classe repository associée,elle ensuite se contente de formater le résultat dans un tableau
      associatif pour faciliter son encodage en format JSON, le tableau contiendra 4 métriques statistiques comme
      indiqué dans les clés du tableau associatif ci-dessous
    */
    public function getGroup1Last7DaysStats($offset=1) {
         $start_date = now()->subDays(6*$offset)->format('Y-m-d');
         $end_date = now()->subDays(6*($offset-1))->format('Y-m-d');

         $results = [
            "SIGNALED_POSTS" => [],
            "SIGNALED_PROFILES" => [],
            "POSTS_WEIGHTED_OVER_THAN_100" => [],
            "SIGNALED_COMMENTS"=>[]
         ];
         
         foreach($results as $key=>$value){
           for($i=0;$i<7;$i++)
               $value[now()->subDays(6*$offset)->addDays($i)->format("Y-m-d")] = 0;
           
           $results[$key] = $value;
         }
        

        $tmp = $this->last7DaysStatsRepo->getGroup1Last7DaysStats($start_date,$end_date);

        foreach($tmp as $value){
           if($value->SET_ORDER==1){
             $results["SIGNALED_POSTS"][$value->DAY] = $value->NBR_IN_THE_DAY;
           }else if($value->SET_ORDER==2){
             $results["SIGNALED_PROFILES"][$value->DAY] = $value->NBR_IN_THE_DAY;
           }else if($value->SET_ORDER==3){
             $results["POSTS_WEIGHTED_OVER_THAN_100"][$value->DAY] +=1;
           }else if($value->SET_ORDER==4){
            $results["SIGNALED_COMMENTS"][$value->DAY] = $value->NBR_IN_THE_DAY;
           }
        }
        return $results;
    } 

     /*
      Cette méthode se charge de récupérer les données retournés de la BD à travers l'invocation de la méthode 
      correspondante de la classe repository associée,
      il s'agit des deux métriques composées nombre d'intéractions et nombre de contributions 
      (les 2 premiers pie charts affichées  sur la page du tableau de bord)
    */
    public function getGroup2Last7DaysStats($offset=1) {
      $start_date = now()->subDays(6*$offset)->format('Y-m-d');
      $end_date = now()->subDays(6*($offset-1))->format('Y-m-d');

      return $this->last7DaysStatsRepo->getGroup2Last7DaysStats($start_date,$end_date);
    }


     /*
      Cette méthode se charge de récupérer les données retournés de la BD à travers l'invocation de la méthode 
      correspondante de la classe repository associée,
      il s'agit des deux métriques composées nombre d'intéractions et nombre de contributions 
      (les 2 derniers pie charts affichées  sur la page du tableau de bord)
    */
    public function getGroup2PerDayLast7DaysStats($offset=1){
      $search_date = now()->subDays($offset-1)->format('Y-m-d');
      return $this->last7DaysStatsRepo->getGroup2PerDayLast7DaysStats($search_date);
    }


    /*
      Cette méthode se charge de récupérer les données retournés de la BD à travers l'invocation de la méthode 
      correspondante de la classe repository associée 
      (se sont les 3 listes des derniers profils utilisateurs, postes et commentaires signalés)
    */
    public function getLastNSignaledPostsAndProfilesAndComments(int $n) {
       return $this->last7DaysStatsRepo->getLastNSignaledPostsAndProfilesAndComments($n);
    }

}