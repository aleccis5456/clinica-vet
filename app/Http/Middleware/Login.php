<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Login
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $lastActivity = session('lastActivityTime', now());
            if (now()->diffInMinutes($lastActivity) > config('session.lifetime')) {
                Auth::logout();
                Session::flush();
                return redirect('/')->with('message', 'Tu sesión ha expirado por inactividad.');
            }
            session(['lastActivityTime' => now()]);
        }
        return $next($request);
    }
}
