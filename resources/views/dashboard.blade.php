{{-- C'est la page web  'tableau de bord' qui contient toutes les métriques statstiques étudiées --}}
@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Tableau de bord')])
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <h3>Statistiques des 2 derniers jours(hier et aujourd'hui)</h3>
      </div>
      <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6">
            <a data-toggle="tooltip" title="Cliquer pour voir plus" href="#">
            <div class="card card-stats">
              <div class="card-header card-header-danger card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">
                    people
                  </i>
                </div>
                <p class="card-category">Total de profils signalés</p>
                <h3 class="card-title">{{ $stats['NBR_SIGNALED_PROFILES'] }}</h3>
              </div>
              <div class="card-footer">
                <div>
                  <p class="text-success">
                    du {{ now()->subDays(1)->format('Y-m-d') }} jusqu'a {{ now()->format('Y-m-d') }}
                  </p>
                </div>
              </div>
            </div>
           </a>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6">
          <a data-toggle="tooltip" title="Cliquer pour voir plus" href="#">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
     
              <div class="card-icon">
                <i class="material-icons">info_outline</i>
              </div>
              <p class="card-category ">Total de posts signalés</p>
              <h3 class="card-title">{{ $stats['NBR_SIGNALED_POSTS'] }}</h3>
            </div>

            <div class="card-footer">
              <div>
                <p class="text-success">
                  du {{ now()->subDays(1)->format('Y-m-d') }} jusqu'a {{ now()->format('Y-m-d') }}
                </p>
              </div>
            </div>
          </div>
          </a>
        </div>

        {{-- NBR_SIGNALED_COMMENTS --}}
        <div class="col-lg-4 col-md-6 col-sm-6">
          <a data-toggle="tooltip" title="Cliquer pour voir plus" href="#">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
     
              <div class="card-icon">
                <i class="material-icons">forum</i>
              </div>
              <p class="card-category ">Total de commentaires signalés</p>
              <h3 class="card-title">{{ $stats['NBR_SIGNALED_COMMENTS'] }}</h3>
            </div>

            <div class="card-footer">
              <div>
                <p class="text-success">
                  du {{ now()->subDays(1)->format('Y-m-d') }} jusqu'a {{ now()->format('Y-m-d') }}
                </p>
              </div>
            </div>
          </div>
          </a>
        </div>        
       
        <div class="col-lg-4 col-md-6 col-sm-6">
            <a data-toggle="tooltip" title="Cliquer pour voir plus" href="#">

            <div class="card card-stats">
              <div class="card-header card-header-success card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">
                    feedback
                 </i>
                </div>
                <p class="card-category">Total de topics crées</p>
                <h3 class="card-title">{{ $stats['NBR_CREATED_TOPICS'] }}</h3>
              </div>
 
              <div class="card-footer">
                <div>
                  <p class="text-success">
                    du {{ now()->subDays(1)->format('Y-m-d') }} jusqu'a {{ now()->format('Y-m-d') }}
                  </p>
                </div>
              </div>
            </div>
          </a>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6">
            <a data-toggle="tooltip" title="Cliquer pour voir plus" href="#">

            <div class="card card-stats">
              <div class="card-header card-header-success card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">
                    login
                  </i>
                </div>
                <p class="card-category">Total de consultations (nbr sessions ouvertes)</p>
                <h3 class="card-title">{{ $stats['NBR_OPENED_SESSIONS'] }}</h3>
              </div>

              <div class="card-footer">
                <div>
                  <p class="text-success">
                    du {{ now()->subDays(1)->format('Y-m-d') }} jusqu'a {{ now()->format('Y-m-d') }}
                  </p>
                </div>
              </div>
            </div>
          </a>
         </div>
      </div>

      {{-- deuxieme ligne de statistiques tjrs dans les statistiques récentes --}}
      <div class="row">
        
      </div>
      <br/><br/>

      <div class="row">
        <h3 >Statistiques sur 7 jours</h3>
      </div>

      <div class="row">
        <button id="show-group-1-stats-btn" class="btn btn-default">
            Afficher les statistiques des 7 derniers jours
            <i id="spinner-stats-group-1" class="fa fa-circle-o-notch fa-spin fa-3x fa-fw" style="display:none;"></i>
            <span class="sr-only">Loading...</span>
        </button>
      </div>

      {{-- BEGIN ERROR MSG DIV --}}
      <div class="row">
        <p id="group1-stats-error-msg" class="text-danger" style="display:none;">Error message must be shown right there</p>
      </div>
    
     {{-- END ERROR MSG DIV --}}
      <div class="row blur-container" id="group-1-stats-container">
        <div class="col-md-6">
          <div class="card card-chart">
            <div class="card-header card-header-info">
              <div class="ct-chart" id="signaledProfiles"></div>
            </div>
            <div class="card-body">
              <h4 class="card-title">Nbr de Profils signalés par jour</h4>
              <p class="card-category">
            </div>
            <div class="card-footer">
              <div>
                <p id="g1-stats-chart1-footer" class="text-success">
                  du {{ now()->subDays(6)->format('Y-m-d') }} jusqu'a {{ now()->format('Y-m-d') }}
                </p>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="card card-chart">
            <div class="card-header card-header-info">
              <div class="ct-chart" id="signaledPosts"></div>    

            </div>
            <div class="card-body">
              <h4 class="card-title">Nbr de Postes signalés par jour</h4>
            </div>
            <div class="card-footer">
              <div>
                <p id="g1-stats-chart2-footer" class="text-success">
                  du {{ now()->subDays(6)->format('Y-m-d') }} jusqu'a {{ now()->format('Y-m-d') }}
                </p>
              </div>
            </div>
          </div>
        </div> 

        <div class="col-md-6">
          <div class="card card-chart">
            <div class="card-header card-header-info">
              <div class="ct-chart" id="signaledComments"></div>    

            </div>
            <div class="card-body">
              <h4 class="card-title">Nbr de Commentaires signalés par jour</h4>
            </div>
            <div class="card-footer">
              <div>
                <p id="g1-stats-chart3-footer" class="text-success">
                  du {{ now()->subDays(6)->format('Y-m-d') }} jusqu'a {{ now()->format('Y-m-d') }}
                </p>
              </div>
            </div>
          </div>
        </div> 


        <div class="col-md-6">
          <div class="card card-chart">
            <div class="card-header card-header-info">
              <div class="ct-chart" id="topPosts"></div>
            </div>
            <div class="card-body">
              <h4 class="card-title">Nbr de Postes de poids >= 100 par jour</h4>
            </div>
            <div class="card-footer">
              <div>
                  <p id="g1-stats-chart4-footer" class="text-success">
                    du {{ now()->subDays(6)->format('Y-m-d') }} jusqu'a {{ now()->format('Y-m-d') }}
                  </p>
              </div>
            </div>
          </div>
        </div>

        <div class="d-flex justify-content-center">
          <nav>
            <ul  class="pagination">
              <li id="g1-paginator-previous-link" class="page-item">
                 <span class="page-link">« 7 jours antérieurs</span>
              </li>
                    
              <li  id="g1-paginator-next-link" class="page-item disabled"  aria-disabled="true">
                <span class="page-link"> 7 jours suivants »</span>
              </li>

              <li>
                <i id="paginator-spinner-stats-group-1" class="fa fa-circle-o-notch fa-spin fa-3x fa-fw" style="display:none;"></i>
              </li>
            </ul>
          </nav>
        </div>        
        {{-- END PAGINATOR ELEMENT --}}
      </div>
      {{-- deuxieme ligne des chartes --}}
      <br/><br/><br/>
      <div class="row">
        <button id="show-group-2-stats-btn" class="btn btn-default">
            Afficher les statistiques des 7 derniers jours
            <i id="spinner-stats-group-2" class="fa fa-circle-o-notch fa-spin fa-3x fa-fw" style="display:none;"></i>
            <span class="sr-only">Loading...</span>
        </button>
      </div>

      {{-- BEGIN ERROR MSG DIV --}}
      <div class="row">
        <p id="group2-stats-error-msg" class="text-danger" style="display:none;">Error message must be shown right there</p>
      </div>

      <div class="row">
        <h3>Statistiques sur la totalité des 7 jours</h3>
      </div>
     {{-- END ERROR MSG DIV --}}  

      <div id="group-2-stats-container" class="row blur-container">
        <div class="col-md-6">
          <div class="card card-chart">
            <div class="card-header card-header-info">
              <h4 class="card-title">Intéractions sur le blog</h4>
            </div>
            <div class="card-body">
              <div class="ct-chart ct-square" id="postsInteraction"></div> 
            </div>
            <div class="card-footer">
              <p id="interactions-total">Total d'intéractions = N</p>
              <p id="g2-stats-chart1-footer" class="text-success">
                du {{ now()->subDays(6)->format('Y-m-d') }} jusqu'a {{ now()->format('Y-m-d') }}
              </p>
            </div>
          </div>
        </div> 

        <div class="col-md-6">
          <div class="card card-chart">
            <div class="card-header card-header-info">
              <h4 class="card-title">Contributeurs à l'échange</h4>
              {{-- <div class="ct-chart" id="websiteViewsChart"></div> --}}
            </div>
            <div class="card-body">
              <div class="ct-chart ct-square" id="exchangeContributors"></div> 
            </div>
            <div class="card-footer">
              <p id="contributors-total">Total de contributeurs = N</p>
              <p id="g2-stats-chart2-footer" class="text-success">
                du {{ now()->subDays(6)->format('Y-m-d') }} jusqu'a {{ now()->format('Y-m-d') }}
              </p>
            </div>
          </div>
        </div> 

        {{-- BEGIN PAGINATOR ELEMENT --}}
        <div class="d-flex justify-content-center">
          <nav>
            <ul  class="pagination">
              <li id="g2-paginator-previous-link" class="page-item">
                 <span class="page-link">« 7 jours antérieurs</span>
              </li>
                    
              <li  id="g2-paginator-next-link" class="page-item disabled"  aria-disabled="true">
                <span class="page-link"> 7 jours suivants »</span>
              </li>

              <li>
                <i id="paginator-spinner-stats-group-2" class="fa fa-circle-o-notch fa-spin fa-3x fa-fw" style="display:none;"></i>
              </li>
            </ul>
          </nav>
        </div>     
      </div>   
        {{-- END PAGINATOR ELEMENT --}}        






{{-- ****************************************** BEGIN WORK PER DAY PIE CHARTS ****************************************** --}}
        <br/><br/>
        <div class="row">
          <button id="show-perDay-group-2-stats-btn" class="btn btn-default">
              Afficher les statistiques par jour des 7 derniers jours
              <i id="spinner-perDay-stats-group-2" class="fa fa-circle-o-notch fa-spin fa-3x fa-fw" style="display:none;"></i>
              <span class="sr-only">Loading...</span>
          </button>
        </div>
  
        {{-- BEGIN ERROR MSG DIV --}}
        <div class="row">
          <p id="group2-perDay-stats-error-msg" class="text-danger" style="display:none;">Error message must be shown right there</p>
        </div>
  
        <div class="row">
          <h3>Statistiques par jour</h3>
        </div>
       {{-- END ERROR MSG DIV --}}  
  
        <div id="group-2-perDay-stats-container" class="row blur-container">
          <div class="col-md-6">
            <div class="card card-chart">
              <div class="card-header card-header-info">
                <h4 class="card-title">Intéractions sur le blog par jour</h4>
              </div>
              <div class="card-body">
                <div class="ct-chart ct-square" id="perDayPostsInteraction"></div> 
              </div>
              <div class="card-footer">
                <p id="perDay-interactions-total">Total d'intéractions dans ce jour = N</p>
                <p id="perDay-g2-stats-chart1-footer" class="text-success">
                  dans le jour : {{ now()->format('Y-m-d') }}
                </p>
              </div>
            </div>
          </div> 
  
          <div class="col-md-6">
            <div class="card card-chart">
              <div class="card-header card-header-info">
                <h4 class="card-title">Contributeurs à l'échange par jour</h4>
                {{-- <div class="ct-chart" id="websiteViewsChart"></div> --}}
              </div>
              <div class="card-body">
                <div class="ct-chart ct-square" id="perDayExchangeContributors"></div> 
              </div>
              <div class="card-footer">
                {{-- <div class="stats"> --}}
                <p id="perDay-contributors-total">Total de contributeurs dans ce jour = N</p>
                <p id="perDay-g2-stats-chart2-footer" class="text-success">
                  dans le jour : {{ now()->format('Y-m-d') }}
                </p>
              </div>
            </div>
          </div> 
  
          {{-- BEGIN PAGINATOR ELEMENT --}}
          <div class="d-flex justify-content-center">
            <nav>
              {{-- BEGIN PAGINATING BY DAY  --}}
              <ul  class="pagination">
                <li id="perDay-g2-paginator-previous-link" class="page-item">
                   <span class="page-link">« jour précedent</span>
                </li>
                      
                <li  id="perDay-g2-paginator-next-link" class="page-item disabled"  aria-disabled="true">
                  <span class="page-link"> jour suivant »</span>
                </li>
  
                <li>
                  <i id="perDay-paginator-spinner-stats-group-2" class="fa fa-circle-o-notch fa-spin fa-3x fa-fw" style="display:none;"></i>
                </li>
              </ul>
             {{-- END PAGINATING BY DAY  --}}

             {{-- BEGIN PAGINATING BY WEEK  --}}
              <ul  class="pagination">
                <li id="perWeek-g2-paginator-previous-link" class="page-item">
                   <span class="page-link">« 7 jours antérieures</span>
                </li>
                      
                <li  id="perWeek-g2-paginator-next-link" class="page-item disabled"  aria-disabled="true">
                  <span class="page-link"> 7 jours suivants »</span>
                </li>
              </ul>
              {{-- END PAGINATING BY WEEK  --}}
            </nav>
          </div>        
          {{-- END PAGINATOR ELEMENT --}}   

{{-- ****************************************** END WORK PER DAY PIE CHARTS ****************************************** --}}




      </div>
      <br><br><br>
      <div class="row">
        <h3 >Actions de signal récentes</h3>
      </div>
      <div class="row">
        <button id="show-last-signaled-posts-profiles-btn" class="btn btn-default">
            Afficher les derniers postes,profils et commentaires signalés
            {{-- <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i> --}}
            <i id="spinner-signals" class="fa fa-circle-o-notch fa-spin fa-3x fa-fw" style="display:none;"></i>
            <span class="sr-only">Loading...</span>
        </button> 
      </div>
      {{-- BEGIN ERROR MSG DIV --}}
      <div class="row">
        <p id="group3-stats-error-msg" class="text-danger" style="display:none;">Error message must be shown right there</p>
      </div>
     {{-- END ERROR MSG DIV --}}        
      <div class="row blur-container" id="last-signaled-posts-and-profiles-container">
     
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-header card-header-danger">
              <h4 class="card-title">Derniers 5 postes signalés</h4>
              {{-- <p class="card-category">New employees on 15th September, 2016</p> --}}
            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover">
                <thead class="text-warning">
                  <th>ID</th>
                  <th>Titre</th>
                  <th>Contenu</th>
                  <th>Publié par</th>
                  <th>Signalé le(dernier signal)</th>
                  <th>Nombre total de signals</th>
                  <th>Liste de signals subis</th>
                  {{-- <th>Voir plus</th> --}}
                </thead>
                <tbody id="dt-posts">
                  <tr>
                    <td>1</td>
                    <td>test title</td>
                    <td>text</td>
                    <td>nom/prenom signaleur</td>
                    <td>06/04/2020</td>
                    <td>20</td>
                    <td><i class="material-icons">visibility</i></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer">
            <a  href="{{route('all-signaled-posts')}}" class="btn btn-success">
               Voir tous
            </a>
          </div>
        </div>

{{-- LAST SIGNALED PROFILES --}}

        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-header card-header-warning">
              <h4 class="card-title">Derniers 5 profils signalés</h4>
              {{-- <p class="card-category">New employees on 15th September, 2016</p> --}}
            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover">
                <thead class="text-warning">
                  <th>ID</th>
                  <th>Nom</th>
                  <th>Prenom</th>
                  <th>Email</th>
                  <th>Date de naissance</th>
                  <th>Signalé le(dernier signal)</th>
                  <th>Nombre total de signals</th>
                  <th>Signals & causes</th>
                </thead>
                <tbody id="dt-profiles">
                  <tr>
                    <td>1</td>
                    <td>Test nom </td>
                    <td>Test prénom</td>
                    <td>test@email.test</td>
                    <td>06/04/2020</td>
                    <td>06/04/2020</td>
                    <td>30</td>
                    <td><i class="material-icons">visibility</i></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer">
            <a href="{{route('all-signaled-profiles')}}" class="btn btn-success">
               Voir tous
            </a>
          </div>
        </div>
     

      {{-- LAST SIGNALED COMMENTS --}}

      <div class="col-lg-12 col-md-12">
        <div class="card">
          <div class="card-header card-header-info">
            <h4 class="card-title">Derniers 5 commentaires signalés</h4>
            {{-- <p class="card-category">New employees on 15th September, 2016</p> --}}
          </div>
          <div class="card-body table-responsive">
            <table class="table table-hover">
              <thead class="text-warning">
                <th>ID</th>
                <th>Contenu</th>
                <th>Rattaché au poste d'ID</th>
                <th>Publié par</th>
                <th>Signalé le(dernier signal)</th>
                <th>Nombre total de signals</th>
                <th>Liste de signals subis</th>

                {{-- <th>Voir plus</th> --}}
              </thead>
              <tbody id="dt-comments">
                <tr>
                  <td>1</td>
                  <td>text</td>
                  <td>3</td>
                  <td>nom/prenom signaleur</td>
                  <td>06/04/2020</td>
                  <td>20</td>
                  <td><i class="material-icons">visibility</i></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer">
          <a href="{{route('all-signaled-comments')}}" class="btn btn-success">
             Voir tous
          </a>
        </div>
      </div>
    </div>
    </div>



    </div>
  </div>
@endsection

@push('js')
  <script src="{{ asset('material') }}/js/plugins/chartist-plugin-tooltip.min.js"></script>
  <script type="text/javascript" src="{{ asset("js/statistics/last_7_days_stats_group_1.js") }}"></script>
@endpush