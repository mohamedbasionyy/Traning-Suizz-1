<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPassword
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle( $request, Closure $next): Response
    {
        if($request->api_password !=env(key:"API_PASSWORD",default:'cbmb8WKZgt')){
            return response()->json(['message'=>'Unauthenticated.']);
        }

        return $next($request);
    }
}
