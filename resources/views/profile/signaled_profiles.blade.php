@extends('layouts.app', ['activePage' => 'signaled-profiles', 'titlePage' => __('postes signalés')])

@section('content')
  <div class="content">
    <div class="container-fluid">
   
      <div class="row">
        <div class="card">
            <div class="card-header card-header-danger">
               <h3 class="card-title">Liste des profils récemment signalés</h3>             
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
                  <th>
                    Signals & causes
                  </th>
                  
                </thead>
                <tbody id="dt-posts">
                  @forelse($data as $item)
                    <tr>
                      <td>{{$item->id}}</td>
                      <td>{{$item->lastname}}</td>
                      <td>{{$item->firstname}}</td>
                      <td>{{$item->email}}</td>
                      <td>{{$item->birthdate}}</td>
                      <td>{{$item->last_signal_date}}</td>
                      <td>{{$item->nbr_of_signals}}</td>
                      <td>
                        <a href="{{  route('profile-signals-contexts',['id'=>$item->id,'fullname'=>$item->firstname.' '.$item->lastname])}}" target="_blank">
                           <i class="material-icons">
                            visibility
                           </i>
                        </a>
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