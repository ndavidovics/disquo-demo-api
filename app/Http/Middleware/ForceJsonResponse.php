<?php

namespace App\Http\Middleware;

use Closure;

class ForceJsonResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    // public function handle($request, Closure $next)
    // {
    //     return $next($request);
    // }

    public function handle($request, Closure $next)
    {
        $request->headers->set('Accept', 'application/json');

        //if JSON is passed without proper headers
       if (!$request->isJson() && $request->json()->all()) {
           $request->request->add($request->json()->all());
       }
        return $next($request);
    }
}
