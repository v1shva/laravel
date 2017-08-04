<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;

use Closure;
use Illuminate\Support\Facades\Cookie;

class LogRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
         \Log::info([
             "REQUEST HEADER ",
             $request->url(),
             $request->headers->get("Cookie"),
             $request->input("_token"),
         ]);
        return $next($request);
    }
}
