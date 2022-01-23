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
        //if JSON is passed instead of form data, add that to the request
        if ($request->json()->all()) {
            $request->request->add($request->json()->all());
        }
        return $next($request);
    }
}
