<?php namespace todolist\Http\Middleware;
use Closure;

use Illuminate\Contracts\Routing\Middleware;
use Illuminate\Http\Response;

class CorsHandler implements Middleware {

    /**
    * Handle an incoming request.
    *
    * @param \Illuminate\Http\Request $request
    * @param \Closure $next
    * @return mixed
    */
    public function handle($request, Closure $next)
    {  
        $content = $next($request);
        return ( new Response($content) )->header('Access-Control-Allow-Origin' , '*')
                                        ->header('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE')
                                        ->header('Access-Control-Allow-Headers', 'Content-Type, X-Auth-Token, Origin');
    }
}