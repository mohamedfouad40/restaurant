<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

            if (Auth::guard('admin')->check()) {
               return redirect(RouteServiceProvider::AdminDashboard);

            }elseif(Auth::guard('web')->check()) {
                return redirect(RouteServiceProvider::HOME);
            }
        

        return $next($request);
    }
}
