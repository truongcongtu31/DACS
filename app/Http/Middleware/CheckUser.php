<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->role !== 'user' || $request->user()->role !== 'admin') {
            return \response()->view('auth.login');
        }
        return $next($request);
    }
}
