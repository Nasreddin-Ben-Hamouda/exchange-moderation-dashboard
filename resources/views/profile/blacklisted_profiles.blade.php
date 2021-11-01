@extends('layouts.app', ['activePage' => 'blacklisted-profiles', 'titlePage' => __('postes signalés')])

@section('content')
  <div class="content">
  
    <div class="container-fluid">
        @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
        <form class="row" method="GET" action="{{route('blacklisted-profiles')}}">
            @csrf
            <div class="col-md-3">
               <label for="threshold">seuil (nbr de signals)</label>
              <input name="threshold" type="text" id="threshold" value="{{ $threshold }}" class="form-control" placeholder="seuil de nbr de signals">
            </div>
            <div class="col-md-3">
              <label for="from-date">de la date</label>
              <input name="from-date" value={{ $from }}  type="date" id="from-date" class="form-control" placeholder="signals à partir de">
            </div>
            <div class="col-md-3">
              <label for="to-date">jusqu'à la date</label>
              <input name="to-date" value={{ $to }}  type="date" id="to-date"  class="form-control" placeholder="signals jusqu'au">
            </div>
            <div class="col-md-3">
              <button type="submit" class="btn btn-info btn-round btn-just-icon">
                <i class="material-icons">search</i>
              </button>
           </div>
        </form>

      <div class="row">
        <div class="card">
            <div class="card-header card-header-danger">
               <h3 class="card-title">Liste des profils blacklistés ( de {{ $from }} jusqu'à {{ $to  }} / seuil = {{ $threshold }})</h3>             
            </div>
            <div class="card-body table-responsive">
             <table class="table table-hover">
                <thead class="text-warning">
                  <th>ID</th>
                  <th>Nom</th>
                  <th>Prenom</th>
                  <th>Email</th>
                  <th>Date de naissance</th>
                  <th>Nbr de signals sur la période</th>
                  <th>Signals & causes</th>
                </thead>
                <tbody id="dt-posts">
                  @forelse ($data as $item)
                    <tr>
                      <td>{{$item->id}}</td>
                      <td>{{$item->lastname}}</td>
                      <td>{{$item->firstname}}</td>
                      <td>{{$item->email}}</td>
                      <td>{{$item->birthdate}}</td>
                      <td>{{$item->nbr_of_signals}}</td>
                      <td><a href="{{ route('profile-signals-contexts',['id'=>$item->id,'fullname'=>$item->firstname.' '.$item->lastname]) }}" target="_blank"><i class="material-icons">visibility</i></a></td>
                    </tr>
                  @empty
                    <tr>
                      <td>
                        <p>Pas de données disponibles ! </p>
                      </td>
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