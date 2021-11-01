<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Ce Middleware permet de controler l'accés aux ressources par role (seul le role de super modérateur posséde la perission d'accéder à la ressource sur laquelle on a appliquée ce middleware)
class SuperModeratorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user() && Auth::user()->isSuperModerator()) {
            return $next($request);
        }
        return redirect("/")->with("error","route inaccessible");
    }
}
