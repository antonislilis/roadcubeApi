<?php

namespace App\Http\Middleware;

use Closure;

class AdminRedirectIfAuthenticated
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
        $user = \Auth::user();

        if(\Auth::user()){

            if($user->role->permissions['account_type']['is_admin']){
                return $next($request);
            }
            else {
                return response('AdminRedirectIfAuthenticated', 401);
                //return redirect()->route('restricted');
               // return response()->view('errors.404', [], 404);
            }
        }

        return $next($request);
    }
}
