<?php

namespace App\Http\Controllers;

use App\Models\PpdbRegistration;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ApplicantAuthController extends Controller
{
    public function loginForm(Request $request)
    {
        if (Auth::check() && ! Auth::user()->isPpdbAdmin()) {
            $registration = PpdbRegistration::where('user_id', Auth::id())->first();
            if ($registration) {
                return redirect()->route('ppdb.sukses', $registration->no_pendaftaran);
            }

            return redirect()->route('ppdb.daftar', ['step' => 1]);
        }

        return view('ppdb.login');
    }

    public function redirectToGoogle(Request $request)
    {
        // Mode pura-pura/demo: jika kredensial Google belum diisi, simulasi login Google agar alur tetap bisa dicoba
        if (! config('services.google.client_id') || ! config('services.google.client_secret')) {
            $key = $request->session()->get('ppdb_demo_key');
            if (! $key) {
                $key = Str::random(24);
                $request->session()->put('ppdb_demo_key', $key);
            }

            $user = User::firstOrCreate(
                ['email' => 'demo+'.$key.'@ppdb.local'],
                [
                    'name' => 'Pendaftar (Demo Google)',
                    'password' => Hash::make(Str::random(32)),
                    'google_id' => 'demo:'.$key,
                    'role' => 'pendaftar',
                ]
            );
            $user->forceFill(['email_verified_at' => $user->email_verified_at ?: now()])->save();

            Auth::login($user, true);
            $request->session()->regenerate();
            $request->session()->put('ppdb_demo_key', $key);

            $registration = PpdbRegistration::where('user_id', $user->id)->first();
            if ($registration) {
                $request->session()->put('ppdb_last_no', $registration->no_pendaftaran);

                return redirect()->route('ppdb.sukses', $registration->no_pendaftaran)
                    ->with('success', 'Mode demo: Anda sudah memiliki pendaftaran.');
            }

            return redirect()->route('ppdb.daftar', ['step' => 1])
                ->with('success', 'Mode demo: login Google disimulasikan (belum terhubung ke Google asli).');
        }

        try {
            return \Laravel\Socialite\Facades\Socialite::driver('google')
                ->redirectUrl(config('services.google_pendaftar.redirect'))
                ->scopes(['openid', 'profile', 'email'])
                ->redirect();
        } catch (\Exception $e) {
            return redirect()->route('ppdb.login')->withErrors(['google' => 'Login Google belum dikonfigurasi. Hubungi panitia.']);
        }
    }

    public function handleGoogleCallback(Request $request)
    {
        try {
            $googleUser = \Laravel\Socialite\Facades\Socialite::driver('google')
                ->redirectUrl(config('services.google_pendaftar.redirect'))
                ->user();

            $email = $googleUser->getEmail();
            $googleId = $googleUser->getId();
            $name = $googleUser->getName() ?: ($email ?: 'Pendaftar');
            $avatar = $googleUser->getAvatar();

            if (! $email && ! $googleId) {
                return redirect()->route('ppdb.login')->withErrors(['google' => 'Data akun Google tidak lengkap.']);
            }

            $user = null;
            if ($googleId) {
                $user = User::where('google_id', $googleId)->first();
            }
            if (! $user && $email) {
                $user = User::where('email', $email)->first();
            }

            if ($user) {
                $user->forceFill(array_filter([
                    'google_id' => $googleId ?: $user->google_id,
                    'name' => $name,
                    'avatar' => $avatar,
                    'email_verified_at' => $user->email_verified_at ?: now(),
                    'role' => $user->isPpdbAdmin() ? $user->role : 'pendaftar',
                ]))->save();
            } else {
                $user = User::create([
                    'name' => $name,
                    'email' => $email ?: ($googleId.'@ppdb.local'),
                    'password' => Hash::make(Str::random(32)),
                    'google_id' => $googleId,
                    'avatar' => $avatar,
                    'role' => 'pendaftar',
                ]);
                $user->forceFill(['email_verified_at' => now()])->save();
            }

            Auth::login($user, true);
            $request->session()->regenerate();

            $registration = PpdbRegistration::where('user_id', $user->id)->first();
            if ($registration) {
                $request->session()->put('ppdb_last_no', $registration->no_pendaftaran);

                return redirect()->route('ppdb.sukses', $registration->no_pendaftaran)
                    ->with('success', 'Anda sudah memiliki pendaftaran.');
            }

            return redirect()->route('ppdb.daftar', ['step' => 1]);
        } catch (\Exception $e) {
            return redirect()->route('ppdb.login')->withErrors(['google' => 'Login Google gagal. Silakan coba lagi.']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('ppdb.home');
    }
}
