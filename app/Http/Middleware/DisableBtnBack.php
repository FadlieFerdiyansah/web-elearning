<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DisableBtnBack
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        $response->headers->set('Cache-Control','nocache,no-store,max-age=0, must-revalidate');
        $response->headers->set('Paragma','nocache');
        $response->headers->set('Expires','Sat, 01 Jan 200 00:00:00 GMT');
        return $response;
    }
}
