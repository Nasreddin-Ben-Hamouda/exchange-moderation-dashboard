<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="#" class="simple-text logo-normal">
      {{ __('Tableau de bord') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Tableau de bord') }}</p>
        </a>
      </li>
      <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management' || $activePage== 'create-moderator') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#laravelExample" aria-expanded="true">
          <i><img style="width:25px" src="{{ asset('material') }}/img/profile.png"></i>
          <p>{{ __('Utilisateurs') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="laravelExample">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('profile.edit') }}">
                <i class="material-icons"> edit </i>
                <span class="sidebar-normal">{{ __('Modifier mon profil ') }} </span>
              </a>
            </li>
            @if (Auth::user()->isSuperModerator()) 
            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('user.index') }}">
                <i class="material-icons"> list </i>
                <span class="sidebar-normal"> {{ __('Gérer les modérateurs') }} </span>
              </a>
            </li>

            <li class="nav-item{{ $activePage == 'create-moderator' ? ' active' : '' }}">
              <a class="nav-link" href="{{ URL('user/create') }}">
                <i class="material-icons"> add </i>
                <span class="sidebar-normal">{{ __('Créer un modérateur ') }} </span>
              </a>
            </li>
            @endif 
          </ul>
        </div>
      </li>

      <li class="nav-item {{ ($activePage == 'signaled-posts' || $activePage == 'signaled-profiles') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#signals-links-section" aria-expanded="true">
          <i class="material-icons">content_paste</i>
          <p>{{ __('Réclamations signals') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="signals-links-section">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'signaled-posts' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('all-signaled-posts') }}">
                <i class="material-icons">content_paste</i>
                <p>{{ __('Postes') }}</p>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'signaled-profiles' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('all-signaled-profiles') }}">
                <i class="material-icons">people</i>
                <p>{{ __('Profils') }}</p>
              </a>
            </li> 
            <li class="nav-item{{ $activePage == 'signaled-comments' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('all-signaled-comments') }}">
                <i class="material-icons">forum</i>
                <p>{{ __('Commentaires') }}</p>
              </a>
            </li> 
          </ul>
        </div>
      </li>


      <li class="nav-item{{ $activePage == 'blacklisted-profiles' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('blacklisted-profiles')}}">
          <i class="material-icons">filter_alt</i>
          <p>{{ __('Profils en BlackList') }} </p>
        </a>
      </li>

    </ul>
  </div>
</div>
