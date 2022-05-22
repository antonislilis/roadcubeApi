<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CheckRole
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
        // if no logged in user exists
        if (!$request->user()) {
            return response()->json([
                'message' => 'Bad request'], ResponseAlias::HTTP_FORBIDDEN);
        }

        // get roles from routes
        $role = $request->route()->getAction()['roles'];
        // get ids of given roles
        $roles = Role::whereIn('role', $role)->select('id')->get();

        if ($roles->isEmpty()) {
            //Auth::logout();
            return response()->json([
                'message' => 'Bad request'], ResponseAlias::HTTP_BAD_REQUEST);

        }

        // convert object to array
        foreach ($roles as $role) {
            $role_ids[] = $role->id;
        }
        // check user role id and roles ids from routes
        if (!in_array($request->user()->role_id, $role_ids)) {
            return response()->json([
                'message' => 'Bad request'], ResponseAlias::HTTP_BAD_REQUEST);
        }

        return $next($request);
    }
}
