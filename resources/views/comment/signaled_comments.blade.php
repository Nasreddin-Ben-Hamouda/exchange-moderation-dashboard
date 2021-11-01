@extends('layouts.app', ['activePage' => 'signaled-comments', 'titlePage' => __('postes signalés')])

@section('content')
  <div class="content">
    <div class="container-fluid">
   
      <div class="row">
        <div class="card">
            <div class="card-header card-header-danger">
               <h3 class="card-title">Liste des commentaires récemment signalés</h3>             
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
                </thead>
                <tbody id="dt-posts">
                  @forelse ($data as $item)
                    <tr>
                      <td>{{$item->id}}</td>
                      <td>{{$item->content}}</td>
                      <td>
                        <a href="{{ route('show-post',['id'=>$item->post_id]) }}" target="_blank">
                          {{$item->post_id}}
                         </a>
                      </td>
                      <td>
                        <a href="{{ route('show-profile',['id'=>$item->user_id]) }}" target="_blank">
                         {{$item->user_firstname.' '.$item->user_lastname.' ( ID = '.$item->user_id.' )'}}
                        </a>
                      </td>
                      <td>{{$item->last_signal_date}}</td>
                      <td>{{$item->nbr_of_signals}}</td>
                      <td>
                        <a href="{{ route('comment-signals',['id'=>$item->id]) }}" target="_blank"><i class="material-icons">visibility</i></a>
                      </td>
                    </tr>
                  @empty
                     <tr>
                       <td><p>Pas de données disponibles ! </p></td>
                     </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
            <div class="card-footer">
               <p></p>
            </div>
        </div>
      </div>
      <div class="d-flex justify-content-center">
        {!! $data->links() !!}
       </div>
    </div>
  </div>
@endsection