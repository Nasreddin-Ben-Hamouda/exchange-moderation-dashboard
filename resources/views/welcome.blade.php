@extends('layouts.app-welcome-page', ['class' => 'off-canvas-sidebar', 'activePage' => 'home', 'title' => __('Page d\'accueil du tableau de bord')])

@section('content')
<div class="container" style="height: auto;">
  <div class="row justify-content-center">
      <div class="col-lg-7 col-md-8">
          <h1 class="text-white text-center">{{ __('Bienvenue au tableau de bord d\'assistance à la modération de votre espace d\'échange') }}</h1>
      </div>
  </div>
</div>
@endsection
