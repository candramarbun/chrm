<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user()== null) {
            //return response("Anda tidak punya hak akses", 401);
            return redirect()->route('signIn');
        }
        $actions = $request->route()->getAction();
        $roles = isset($actions['roles']) ? $actions['roles']: null;

        if ($request->user()->hasAnyRole($roles) || !$roles) {
           return $next($request); 
        }
        return response("Anda tidak punya hak akses", 401 );
    }
}
