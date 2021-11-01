<?php
namespace App\Repositories;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
/*
  Classe responsable d'intéragir directement avec la BD pour fournir des données/métrique statistiques relatives aux  statistiques
  calculées sur les 7 dernièrs jours , ses méthodes sont invoquées par les classes services correspondantes
*/
class Last7DaysStatsRepository {

    /*
      Cette méthode permet de récuperer les statistiques affichés sur les 4 chartes en bleu sur la page du tableau de bord
    */
    public function getGroup1Last7DaysStats($start_date,$end_date){
        $sqlQuery = Config::get('statistics_queries.GET_LAST7DAYS_GROUP1_COUNTS_QUERY');

        $sqlQuery = str_replace(":start_date", $start_date, $sqlQuery);
        $sqlQuery = str_replace(":end_date", $end_date, $sqlQuery);


        $sqlQuery  = \AppHelper::instance()::cleanUpSqlQuery($sqlQuery);

        return DB::select($sqlQuery);
    }


    /*
      Cette méthode permet de récuperer les statistiques affichés sur les 2 premieres pie charts en jaune  sur la page du tableau de bord
    */
    public function getGroup2Last7DaysStats($start_date,$end_date){
        $sqlQuery = Config::get('statistics_queries.GET_LAST7DAYS_GROUP2_COUNTS_QUERY');

        $sqlQuery = str_replace(":start_date", $start_date, $sqlQuery);
        $sqlQuery = str_replace(":end_date", $end_date, $sqlQuery);

        $sqlQuery  = \AppHelper::instance()::cleanUpSqlQuery($sqlQuery);

        return DB::select($sqlQuery);
    }

    /*
      Cette méthode permet de récuperer les statistiques affichés sur les 2 dernières pie charts en jaune  sur la page du tableau de bord
    */
    public function getGroup2PerDayLast7DaysStats($search_date){
        $sqlQuery = Config::get('statistics_queries.GET_LAST7DAYS_PER_DAY_GROUP2_COUNTS_QUERY');

        $sqlQuery = str_replace(":search_date", $search_date, $sqlQuery);

        $sqlQuery  = \AppHelper::instance()::cleanUpSqlQuery($sqlQuery);

        return DB::select($sqlQuery);
    }


    /*
      Cette méthode permet de récuperer les listes de derniers uilisateurs (profils),commentaires et postes signalés
    */
    public function getLastNSignaledPostsAndProfilesAndComments(int $n) {
        $sqlQuery = Config::get('statistics_queries.GET_LAST_N_SIGNALED_POSTS_AND_PROFILES_AND_COMMENTS');
        $sqlQuery = str_replace(":N", $n,$sqlQuery);
        $sqlQuery  = \AppHelper::instance()::cleanUpSqlQuery($sqlQuery);

        return DB::select($sqlQuery);
    }

}
