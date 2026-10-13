<?php

namespace App\Http\Controllers;

use App\Models\PpdbRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPpdbController extends Controller
{
    public function loginForm()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('ppdb.home');
    }

    public function dashboard(Request $request)
    {
        $query = PpdbRegistration::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('jalur')) {
            $query->where('jalur', $request->jalur);
        }
        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_lengkap', 'like', '%'.$request->q.'%')
                  ->orWhere('no_pendaftaran', 'like', '%'.$request->q.'%')
                  ->orWhere('asal_sekolah', 'like', '%'.$request->q.'%');
            });
        }

        $pendaftar = $query->latest()->paginate(15)->withQueryString();
        $stats = [
            'total' => PpdbRegistration::count(),
            'pending' => PpdbRegistration::where('status', 'pending')->count(),
            'diverifikasi' => PpdbRegistration::where('status', 'diverifikasi')->count(),
            'diterima' => PpdbRegistration::where('status', 'diterima')->count(),
            'ditolak' => PpdbRegistration::where('status', 'ditolak')->count(),
        ];

        return view('admin.dashboard', compact('pendaftar', 'stats'));
    }

    public function show(PpdbRegistration $pendaftar)
    {
        return view('admin.show', compact('pendaftar'));
    }

    public function updateStatus(Request $request, PpdbRegistration $pendaftar)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,diverifikasi,diterima,ditolak',
            'catatan_admin' => 'nullable|string',
        ]);

        $pendaftar->update($validated);

        return back()->with('success', 'Status '.$pendaftar->no_pendaftaran.' diubah ke '.$validated['status']);
    }

    public function destroy(PpdbRegistration $pendaftar)
    {
        $pendaftar->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Data dihapus.');
    }
}
