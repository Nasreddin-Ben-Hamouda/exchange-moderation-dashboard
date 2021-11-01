<?php
namespace App\Repositories;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

/*
  Classe responsable d'intéragir directement avec la BD pour fournir des données/métrique statistiques relatives aux métriques statistiques récentes
  calculées sur les dernieres 48 heures
*/
class RecentStatsRepository {

    /*
      Cette méthode permet de récupérer les données de la BD et qui permettent de construire les 5 métriques statistiques récentes :
      1)Total des profils signalés(utilisateurs du blog) sur les dernières 48 heures
      2)Total des postes signalés sur les dernières 48 heures
      3)Total des commentaires signalés sur les dernières 48 heures
      5)Total de nouveaux topics crées durant les dernières 48 heures
      5)Total des sessions de connexions ouvertes durant les dernières 48 heures
    */
    public function getLast2DaysStats($start_date,$end_date){
       $sqlQuery = Config::get('statistics_queries.GET_LAST2DAYS_COUNTS_QUERY');
       $sqlQuery = str_replace(":start_date", $start_date, $sqlQuery);
       $sqlQuery = str_replace(":end_date", $end_date, $sqlQuery);

       $sqlQuery  = \AppHelper::instance()::cleanUpSqlQuery($sqlQuery);

       return DB::select($sqlQuery);
    }

}
