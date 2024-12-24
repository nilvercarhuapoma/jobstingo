<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckJobOption
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $requiredOption
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $requiredOption)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión.');
        }

        if (Auth::user()->job_option !== $requiredOption) {
            return redirect()->route('welcome')->with('error', 'No tienes acceso a esta funcionalidad.');
        }

        return $next($request);
    }
}
