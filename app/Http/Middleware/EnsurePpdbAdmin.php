<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsurePpdbAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        $allowed = array_filter(array_map('trim', explode(',', (string) env('PPDB_ADMIN_EMAILS', 'admin@smasantopaulus.sch.id'))));

        if (! $user || ! in_array($user->email, $allowed, true)) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('admin.login')->withErrors(['email' => 'Akun ini tidak memiliki akses admin PPDB.']);
        }

        return $next($request);
    }
}
