
@extends('layouts.app', ['activePage' => 'user-management', 'titlePage' => __('Tableau de bord')])
@push("styles")
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
@endpush
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
         @if(session()->has("success_msg"))
           <div class="alert alert-success" role="alert">
             <p>{{session()->get("success_msg") }}</p>
           </div>
          @endif
          <div class="card">
            <div class="card-header card-header-info">
              <h4 class="card-title ">Modérateurs</h4>
              <p class="card-category"> Gestion des modérateurs</p>
            </div>
            <div class="card-body">
               <div class="row">
                <div class="col-12 text-right">
                  <a href="{{ URL('user/create') }}" class="btn btn-sm btn-success"> <i class="material-icons">add</i> Ajouter un modérateur</a>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table">
                  <thead class=" text-primary">
                    <tr><th>
                        Nom
                    </th>
                    <th>
                      Email
                    </th>
                    <th>
                      Date de création
                    </th>
                    <th class="text-right">
                      Actions
                    </th>
                  </tr></thead>
                  <tbody>
                    @foreach ($users as $user)
                      <tr>
                        <td>
                          {{ $user->name }}
                        </td>
                        <td>
                          {{ $user->email }}
                        </td>
                        <td>
                          {{ $user->created_at }}
                        </td>
                        <td class="td-actions text-right">
                              <a rel="tooltip" class="btn btn-success btn-link" href="{{ URL("user/".$user->id."/edit") }}" data-original-title="" title="">
                              <i class="material-icons">edit</i>
                              <div class="ripple-container"></div>
                            </a>
                            {{-- BEGIN DELETE MODERATOR FORM --}}
                            <form style="margin-top:20px;" method="POST" action="{{ URL('user/'.$user->id)}}">
                              @csrf
                              @method("DELETE")
                              <button type="submit" class="btn btn-danger btn-link" onclick="return confirm('voulez-vous vraiment supprimer le moderateur ?')">
                                <i class="material-icons">delete</i>
                              </button>
                            </form>
                           {{-- END DELETE MODERATOR FORM --}}
                          
                         </td>
                      </tr>
                    @endforeach
                 </tbody>
                </table>
              </div>

    

            </div>

          </div>
          <div class="d-flex justify-content-center">
            {!! $users->links() !!}
          </div>
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


