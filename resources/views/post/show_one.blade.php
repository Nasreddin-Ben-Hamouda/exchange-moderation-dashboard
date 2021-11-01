@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Tableau de bord')])
@section('content')
{{-- {{dd($post)}} --}}
<div class="content">
    <div class="container-fluid">
      <div class="row d-flex justify-content-center">
        {{-- <h3>Affichage relatif au poste</h3> --}}
      </div>
      <div class="row d-flex justify-content-center">
        <div class="card col-lg-6">
          <h4 class="card-header d-flex justify-content-center">Affichage relatif au poste</h4>
          <div class="card-body">
             <table  class="table table-hover">
                 <thead>

                 </thead>
                 <tbody>
                      <tr>
                        <td><b>ID</b></td>
                        <td>{{ $post->id }}</td>
                      </tr>
                      <tr>
                        <td><b>Titre</b></td>
                        <td>{{ $post->title }}</td>
                      </tr>
                      <tr>
                        <td><b>Contenu</b></td>
                        <td>{{ $post->content }}</td>
                      </tr>
                      <tr>
                        <td><b>Crée Par</b></td>
                        <td><a href="{{ route('show-profile',['id'=>$post->user_id]) }}" target="_blank">L'utilisateur d'ID {{ $post->user_id }}</a></td>
                      </tr>  
                      <tr>
                        <td><b>Crée le</b></td>
                        <td>{{ $post->created_at }}</td>
                      </tr>  
                      <tr>
                        <td><b>Topics associés</b></td>
                        <td>
                          <ul>
                          @foreach ($post->topics as $topic)
                              <li>{{ $topic->label }}</li>
                          @endforeach
                          </ul>
                        </td>
                      </tr>                                           
                 </tbody>
             </table>
          </div>
        </div>     
      </div>
    </div>
</div>
@endsection