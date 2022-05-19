<?php

namespace App\Http\Middleware;

use App\Models\Log;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class RequestLoggerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }

    public function terminate(Request $request, JsonResponse $response)
    {
        $user = \Auth::user();
        $log = new Log();
        $log->time = date('Y-m-d H:i:s', LARAVEL_START);
        $log->ip = $request->ip();
        $log->method = $request->method();
        $log->body = $request->getContent();
        $log->header = $request->header()['user-agent'][0];
        $log->url = $request->url();
        $log->status_code = $response->getStatusCode();
        $log->user_name = $user['name'] ?? null;
        $log->user_id = $user['id'] ?? null;

        $log->save();
    }
}
