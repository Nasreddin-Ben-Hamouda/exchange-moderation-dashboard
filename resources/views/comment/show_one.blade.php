@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Tableau de bord')])
@section('content')
{{-- {{dd($comment)}} --}}
<div class="content">
    <div class="container-fluid">
      <div class="row d-flex justify-content-center">
        {{-- <h3>Affichage relatif au commentaire</h3> --}}
      </div>
      <div class="row d-flex justify-content-center">
        <div class="card col-lg-6">
          <h5 class="card-header d-flex justify-content-center">Affichage relatif au commentaire</h5>
          <div class="card-body">
             <table  class="table table-hover">
                 <thead>
                    {{-- <th>Attribut</th>
                    <th>Valeur</th> --}}
                 </thead>
                 <tbody>
                      <tr>
                        <td><b>ID</b></td>
                        <td>{{ $comment->id }}</td>
                      </tr>
                      <tr>
                        <td><b>Contenu</b></td>
                        <td>{{ $comment->content }}</td>
                      </tr>
                      <tr>
                        <td><b>Crée le</b></td>
                        <td>{{ $comment->created_at }}</td>
                      </tr>    
                      <tr>
                        <td><b>Publié par</b></td>
                        <td>
                          <a target="_blank" href="{{ route("show-profile",['id'=>$comment->user_id]) }}">L'utilisateur d'ID {{ $comment->user_id }}</a>
                        </td>
                      </tr> 
                      <tr>
                        <td><b>Associé au post</b></td>
                        <td>
                          <a target="_blank" href="{{ route("show-post",['id'=>$comment->post_id]) }}">Le post d'ID {{ $comment->post_id }}</a>
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