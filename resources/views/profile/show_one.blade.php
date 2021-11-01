@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Tableau de bord')])
@section('content')
{{-- {{dd($profile)}} --}}
<div class="content">
    <div class="container-fluid">
      <div class="row d-flex justify-content-center">
        {{-- <h3>Affichage relatif au commentaire</h3> --}}
      </div>
      <div class="row d-flex justify-content-center">
        <div class="card col-lg-6">
          <h5 class="card-header d-flex justify-content-center">Affichage relatif au profil utilisateur</h5>
          <div class="card-body">
             <table  class="table table-hover">
                 <thead>
                 </thead>
                 <tbody>
                      <tr>
                        <td><b>ID</b></td>
                        <td>{{ $profile->id }}</td>
                      </tr>
                      <tr>
                        <td><b>Prénom</b></td>
                        <td>{{ $profile->firstname }}</td>
                      </tr>
                      <tr>
                        <td><b>Nom</b></td>
                        <td>{{ $profile->lastname }}</td>
                      </tr> 
                      <tr>
                        <td><b>Email</b></td>
                        <td>{{ $profile->email }}</td>
                      </tr>    
                      <tr>
                        <td><b>Date de naissance</b></td>
                        <td>{{ $profile->birthdate }}</td>
                      </tr>   
                      <tr>
                        <td><b>Crée le</b></td>
                        <td>{{ $profile->created_at }}</td>
                      </tr>                                              
                 </tbody>
             </table>
          </div>
        </div>     
      </div>
    </div>
</div>
@endsection