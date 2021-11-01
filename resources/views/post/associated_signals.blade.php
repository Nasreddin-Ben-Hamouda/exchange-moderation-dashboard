@extends('layouts.app', ['activePage' => '', 'titlePage' => __('Tableau de bord')])
@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <h3>Affichage relatif aux signals subis par le poste d'ID {{$id}}</h3>
      </div>

      <div class="row">
                 <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-header card-header-warning">
              <h4 class="card-title">Ensemble des signals subis</h4>
              {{-- <p class="card-category">New employees on 15th September, 2016</p> --}}
            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover">
                <thead class="text-warning">
                  <th>ID signal</th>
                  <th>date</th>
                  <th>Signalé Par</th>
                </thead>
                <tbody id="dt-profiles">
                 @foreach ($signals as $signal)
                   <tr>
                     <td>{{$signal->id}}</td>
                     <td>{{$signal->created_at}} </td>
                     <td><a href="{{ route('show-profile',['id'=>$signal->user_id]) }}" target="_blank">L'utlisateur {{$signal->signalerUser->firstname}} {{$signal->signalerUser->lastname}} d'ID {{ $signal->user_id }}</a></td>                   </tr>
                 @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer">
            <div class="d-flex justify-content-center">
                {!! $signals->links() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection