<?php

namespace App\Http\Middleware;

use App\Models\PpdbRegistration;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsurePpdbApplicant
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if (! $user) {
            return redirect()->guest(route('ppdb.login'));
        }

        if ($user->isPpdbAdmin()) {
            return $next($request);
        }

        $registration = PpdbRegistration::where('user_id', $user->id)->first();
        if ($registration) {
            $request->session()->put('ppdb_last_no', $registration->no_pendaftaran);

            return redirect()->route('ppdb.sukses', $registration->no_pendaftaran)
                ->with('success', 'Anda sudah mengirim pendaftaran. Gunakan halaman ini untuk melihat data Anda.');
        }

        return $next($request);
    }
}
