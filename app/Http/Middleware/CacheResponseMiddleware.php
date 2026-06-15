<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CacheResponseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Only cache GET requests that are successful (200 OK)
        if ($request->isMethod('GET') && $response->status() == 200) {
            // Set Cache-Control header for 1 hour (3600 seconds)
            // It allows public caching (e.g. by browsers or intermediate proxies)
            $response->headers->set('Cache-Control', 'public, max-age=3600');
        }

        return $response;
    }
}
