<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AdminRedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = \Auth::user();
        if ($user && $user->role->permissions['account_type']['is_admin']) {
            return $next($request);
        }
        return response('AdminRedirectIfAuthenticated', ResponseAlias::HTTP_UNAUTHORIZED);
    }
}

