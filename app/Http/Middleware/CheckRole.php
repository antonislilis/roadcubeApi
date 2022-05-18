<?php

	namespace App\Http\Middleware;

	use App\Models\Role;
    use Closure;
	use URL;
	use Illuminate\Support\Facades\Auth;

	class CheckRole{
		/**
		 * Handle an incoming request.
		 *
		 * @param  \Illuminate\Http\Request  $request
		 * @param  \Closure  $next
		 * @return mixed
		 */
		public function handle($request, Closure $next)
		{
			// if no logged in user exists
			if(!$request->user()) {
				return redirect('login');
			}

			// get roles from routes
			$role = $request->route()->getAction()['roles'];

			// get ids of given roles
			$roles = Role::whereIn('role', $role)->select('id')->get();

			if($roles->isEmpty()) {
				//Auth::logout();
				return \Redirect::away(URL::previous());

			}

			// convert object to array
			foreach ($roles as $key => $role) {
				$role_ids[] = $role->id;
			}

			// check user role id and roles ids from routes
			if(!in_array($request->user()->role_id, $role_ids)) {

				return redirect('restricted')->with('url', '/home');
			}

			return $next($request);
		}
	}
