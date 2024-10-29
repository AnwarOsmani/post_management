<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $userRole = Auth::user()->role;
        if ($userRole == 1) {
            return redirect()->route('superadmin.dashboard');
        } elseif ($userRole == 2) {
            return $next($request);
        } elseif ($userRole == 3) {
            return redirect()->route('worker.dashboard');
        }
        return redirect()->route('dashboard');
    }
}
