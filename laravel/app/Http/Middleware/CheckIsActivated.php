<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIsActivated
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(is_null($request->user())) {
            return redirect('/login');
        }
        if (is_null($request->user()->activated_at)) {
            return redirect('/dashboard');
        }

        return $next($request);
    }
}
