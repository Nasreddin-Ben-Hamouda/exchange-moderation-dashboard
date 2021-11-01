@extends('layouts.app', ['activePage' => 'create-moderator', 'titlePage' => __('Tableau de bord')])
@section('content')
<div class="content">
   <div class="container-fluid">
  <div class="row align-items-center">
    <div class="col-lg-5 col-md-6 col-sm-8 ml-auto mr-auto" style="margin-top:20px;">
      {{-- <div class="alert alert-success" role="alert">    <p>TEST TEXT SUCCESS MESSAGE</p>    </div> --}}

      @if(session()->has("success_msg") && session()->has("email") && session()->has("password"))
        <div class="alert alert-success" role="alert">
          <p>{{session()->get("success_msg") }}</p>
          <p><b>email : {{session()->get("email") }}</b></p>
          <p><b>mot de passe :{{session()->get("password") }}</b></p>
        </div>
      @endif
      <form class="form" method="POST" action="{{ URL('user') }}">
        @csrf
        <div class="card card-login card-hidden mb-3">
          <div class="card-header card-header-info text-center">
            <h4 class="card-title"><strong>{{ __('Créer un Modérateur') }}</strong></h4>
          </div>
          <div class="card-body ">
            <p class="card-description text-warning">* tous les champs sont obligatoires</p> 
            <div class="bmd-form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                      <i class="material-icons">face</i>
                  </span>
                </div>
                <input type="text" name="name" class="form-control" placeholder="{{ __('Nom Prénom...') }}" value="{{ old('name') }}" required>
              </div>
              @if ($errors->has('name'))
                <div id="name-error" class="error text-danger pl-3" for="name" style="display: block;">
                  <strong>{{ $errors->first('name') }}</strong>
                </div>
              @endif
            </div>
            <div class="bmd-form-group{{ $errors->has('email') ? ' has-danger' : '' }} mt-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">email</i>
                  </span>
                </div>
                <input type="email" name="email" class="form-control" placeholder="{{ __('Email...') }}" value="{{ old('email') }}" required>
              </div>
              @if ($errors->has('email'))
                <div id="email-error" class="error text-danger pl-3" for="email" style="display: block;">
                  <strong>{{ $errors->first('email') }}</strong>
                </div>
              @endif
            </div>
            <div class="bmd-form-group{{ $errors->has('password') ? ' has-danger' : '' }} mt-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">lock_outline</i>
                  </span>
                </div>
                <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('Mot de passe (8 caractéres au minimun)...') }}" required>
              </div>
              @if ($errors->has('password'))
                <div id="password-error" class="error text-danger pl-3" for="password" style="display: block;">
                  <strong>{{ $errors->first('password') }}</strong>
                </div>
              @endif
            </div>
            <div class="bmd-form-group{{ $errors->has('password_confirmation') ? ' has-danger' : '' }} mt-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">lock_outline</i>
                  </span>
                </div>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="{{ __('Confirmer le mot de passe...') }}" required>
              </div>
              @if ($errors->has('password_confirmation'))
                <div id="password_confirmation-error" class="error text-danger pl-3" for="password_confirmation" style="display: block;">
                  <strong>{{ $errors->first('password_confirmation') }}</strong>
                </div>
              @endif
            </div>
            <div class="form-check mr-auto ml-3 mt-3">
                <p></p>
              {{-- <label class="form-check-label">
                <input class="form-check-input" type="checkbox" id="policy" name="policy" {{ old('policy', 1) ? 'checked' : '' }} >
                <span class="form-check-sign">
                  <span class="check"></span>
                </span>
                {{ __('I agree with the ') }} <a href="#">{{ __('Privacy Policy') }}</a>
              </label>--}}
            </div> 
          </div>
          <div class="card-footer justify-content-center">
             <div class="pl-3">
                <button type="submit" class="btn btn-success  btn-lg">{{ __('Créer modérateur') }}</button>
             </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
@endsection


                    
@push("js")
   <script>
        // Facebook Pixel Code Don't Delete
          ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
              n.callMethod ?
                n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
          }(window,
            document, 'script', '//connect.facebook.net/en_US/fbevents.js');
          try {
            fbq('init', '111649226022273');
            fbq('track', "PageView");
          } catch (err) {
            console.log('Facebook Track Error:', err);
          }
  </script>    
      
  <noscript>
     <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=111649226022273&ev=PageView&noscript=1" />
   </noscript>    
@endpush


