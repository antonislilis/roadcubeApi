<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CheckPermission
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
        // get user permissions by its role
        $permissions = !$request->user()
            ? Role::where('role', 'guest')->first()->permissions
            : Auth::user()->role->permissions;
        // get permissions from routes
        $routePermissions = $request->route()->getAction()['permissions'];
        // check if array is multidimensional and if we gave a key(index) that is not exists on permissions
        if (count($routePermissions) != count($routePermissions, COUNT_RECURSIVE) && !count(array_diff_key($routePermissions, $permissions))) {
            foreach ($routePermissions as $key => $aPermission) {
                foreach ($aPermission as $perm) {
                    // check if the permission key exists
                    if (!array_key_exists($perm, $permissions[$key]) || $permissions[$key][$perm] !== true) {
                        return response()->json([
                            'message' => 'You dont have the permissions for this action'], ResponseAlias::HTTP_UNAUTHORIZED);
                        // you don't have permission or a permission from routes is not correct
                    }
                }
            }
        } else {
            return response()->json([
                'message' => 'Bad request'], Response::HTTP_BAD_REQUEST);
            // array is not multidimensional or an array index from routes is not correct
        }

        return $next($request);
    }
}
