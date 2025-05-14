<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response | JsonResponse
    {
        if(Auth::guard('admin')->check())
        {
            return redirect(route('dashboard'));
        }
        else if(Auth::guard('guru')->check())
        {
            return redirect(route('guru.dashboard'));
        }
        else if(Auth::guard('murid')->check())
        {
            return redirect(route('murid.dashboard'));
        }

        return $next($request);
    }
}
