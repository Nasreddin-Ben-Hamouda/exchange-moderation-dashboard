<?php

namespace App\Http\Controllers;

use App\Services\RecentStatsService;

/*
 Se controleur http est responsable d'afficher la page du tableau de bord en retournant les données de base qui seront affichés lors du  chargement de la page
*/
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

     protected $recentStatsService;

    public function __construct(RecentStatsService $recentStatsService){
        $this->recentStatsService = $recentStatsService;
        $this->middleware('auth');
    }

    /*
      Cette méthode retourne les données de base qui seront affichés lors du  chargement de la page du tableau de bord telque les métriques suivantes  : 
      1) Total des profils signalés sur les dernieres 48 heures
      2) Total des postes signalés sur les dernieres 48 heures
      3) Total des commentaires signalés sur les dernieres 48 heures
      4) Total des topics crées durant les dernieres 48 heures
      5) Total des sessions ouvertes durant les dernieres 48 heures
    */
    public function index()
    {
        return view('dashboard')
          ->with("stats",$this->recentStatsService->getLast2DaysStats());
    }
}
