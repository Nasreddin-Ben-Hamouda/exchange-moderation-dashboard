<?php

namespace App\Http\Controllers;

use App\Services\Last7DaysStatsService;
use Illuminate\Http\Request;
/*
 Ce Controleur http se charge de servir toutes les requetes ajax en provenance de la page du tableau de bord comme : 
*/
class AjaxDashboardChartStatsController extends Controller
{
    /* la classe service suivante se charge d'invoquer la classe repository qui elle responsable d'interroger la BD pour les données, 
       la classe service ensuite récupére et formate les données et le retorunet vers la méthode appelante de cette classe controller
       la méthode du controleur retourne finalement le réultat en format json dans la réponse http
    */
    protected $last7DaysStatsService;
    

    /* 
      On utilise ici $this->middleware('auth'); pour sécuriser toutes les routes http couplés avec les méthodes de ce controleur pour un accés exclusif seulement peri aux
      modérateurs déja authentifiés ( controle d'authentification pour l'accés au ressources )
    */
    public function __construct(Last7DaysStatsService $last7DaysStatsService){
        $this->last7DaysStatsService = $last7DaysStatsService;
        $this->middleware('auth');
    }

    /*
       Cette méthode retourne les données pour les 4 chartes qui représentent des graphes linéaires pour les 4 métriques : 
       : Nbr de Profils signalés par jour, Nbr de Postes signalés par jour, Nbr de Commentaires signalés par jour ET Nbr de Postes de poids >= 100 par jour 
    */
    public function getAllChartsStatsForGroup1(Request $request) {
      if($request->ajax()){
        return json_encode($this->last7DaysStatsService->getGroup1Last7DaysStats($request->query("offset")));
      }
    }

    /*
       Cette méthode retourne les données pour les 2 premiers pie charts affichés dans le tableau de bord et qui représentent respectivement : 
       Les pourcentages des intéractions sur le blog sur les 7 derniers jours ET les pourcentages des contributeurs à l'échange sur les 7 dernier jours
    */
    public function getAllChartsStatsForGroup2(Request $request) {
      if($request->ajax()){
         $tab  = $this->last7DaysStatsService->getGroup2Last7DaysStats($request->query("offset"));
         if(is_array($tab) && !empty($tab)){
            $tab = (array)$tab[0];
            arsort($tab);
         }
         return json_encode($tab);
      }
    }

    /*
       Cette méthode retourne les données pour les 2 dernières pie charts affichés dans le tableau de bord et qui représentent respectivement : 
       Les pourcentages des intéractions sur le blog sur le jour courant(1 seul jour donc statistiques par jour)  ET les pourcentages des contributeurs à l'échange sur le jour courant(1 seul jour donc statistiques par jour)
    */
    public function getPerDayAllPieChartsStatsForGroup2(Request $request) {
      if($request->ajax()){
        $tab = $this->last7DaysStatsService->getGroup2PerDayLast7DaysStats($request->query("offset")); 
        if(is_array($tab) && !empty($tab)){
          $tab = (array)$tab[0];
          arsort($tab);
        }
        return json_encode($tab);
      }
    }

    /*
       Cette méthode retourne les 5 derniers : postes signalés, profils signalés ET commentaires signalés et qui sont affichés en bas de la page du tableau de bord
    */
    public function getLastSignaledPostsAndProfilesAndCommentsGroup3Stats(Request $req) {
      if($req->ajax()){
        return json_encode($this->last7DaysStatsService->getLastNSignaledPostsAndProfilesAndComments($req->query("n") ?? 5));
      } 
   }
}
