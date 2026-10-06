<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureLoggedIn
{
    public function handle(Request $request, Closure $next)
    {
        if (! $request->session()->has('user')) {
            return redirect('/')->with('error', 'Silakan login dulu sebagai Guru atau Murid.');
        }
        return $next($request);
    }
}
