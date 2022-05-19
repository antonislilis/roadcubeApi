<?php

namespace App\Http\Middleware;

use Closure;
use Auth;


class AdminGuard
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
        $userRoles = [];
        if (Auth::user()) {
            $userRoles = Auth::user()->roles->pluck('name')->all();
        }
        $isRoleAdminOrRoot = [
            in_array('root', $userRoles),
            in_array('admin', $userRoles)
        ];

        if (!Auth::check() || !in_array(true, $isRoleAdminOrRoot)) {
            return response('You dont have access', 403);
        }

        return $next($request);
    }
}
