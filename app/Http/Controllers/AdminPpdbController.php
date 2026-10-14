<?php

namespace App\Http\Controllers;

use App\Models\PpdbRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            'email' => 'required|email|max:255',
            'password' => 'required|string|max:255',
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
        $filters = $request->validate([
            'status' => 'nullable|in:pending,diverifikasi,diterima,ditolak',
            'jalur' => 'nullable|in:reguler,prestasi,afirmasi',
            'q' => 'nullable|string|max:100',
        ]);

        $query = PpdbRegistration::query();

        if (! empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }
        if (! empty($filters['jalur'])) {
            $query->where('jalur', $filters['jalur']);
        }
        if (! empty($filters['q'])) {
            $search = $filters['q'];
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', '%'.$search.'%')
                    ->orWhere('no_pendaftaran', 'like', '%'.$search.'%')
                    ->orWhere('asal_sekolah', 'like', '%'.$search.'%');
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
            'catatan_admin' => 'nullable|string|max:2000',
        ]);

        $pendaftar->update($validated);

        return back()->with('success', 'Status '.$pendaftar->no_pendaftaran.' diubah ke '.$validated['status']);
    }

    public function destroy(PpdbRegistration $pendaftar)
    {
        $files = array_filter([
            $pendaftar->file_kk,
            $pendaftar->file_akta,
            $pendaftar->file_ktp_ortu,
            $pendaftar->file_baptis,
            $pendaftar->file_rapor_8_ganjil,
            $pendaftar->file_rapor_8_genap,
            $pendaftar->file_foto,
            $pendaftar->file_bukti_transfer,
        ]);

        $pendaftar->delete();

        if ($files !== []) {
            Storage::disk('public')->delete($files);
        }

        return redirect()->route('admin.dashboard')->with('success', 'Data dan berkas dihapus.');
    }

    public function export()
    {
        $rows = PpdbRegistration::latest()->get([
            'no_pendaftaran', 'nama_lengkap', 'nisn', 'nik', 'jenis_kelamin',
            'tanggal_lahir', 'no_hp', 'asal_sekolah', 'asal_smp_kategori',
            'jalur', 'gelombang', 'skema_bayar', 'status', 'created_at',
        ]);

        $callback = function () use ($rows) {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['No', 'Nama', 'NISN', 'NIK', 'JK', 'Tgl Lahir', 'HP', 'Asal SMP', 'Kategori', 'Jalur', 'Gelombang', 'Skema', 'Status', 'Daftar']);
            foreach ($rows as $r) {
                fputcsv($out, array_map(function ($v) {
                    $v = (string) ($v ?? '');
                    // Cegah formula injection saat dibuka di Excel
                    if (preg_match('/^[=+\-@]/', $v)) {
                        $v = "'".$v;
                    }

                    return $v;
                }, [
                    $r->no_pendaftaran, $r->nama_lengkap, $r->nisn, $r->nik,
                    $r->jenis_kelamin, $r->tanggal_lahir?->format('Y-m-d'), $r->no_hp,
                    $r->asal_sekolah, $r->asal_smp_kategori, $r->jalur,
                    $r->gelombang, $r->skema_bayar, $r->status,
                    $r->created_at->format('Y-m-d H:i'),
                ]));
            }
            fclose($out);
        };

        return response()->streamDownload($callback, 'spmb-2027-pendaftar.csv', ['Content-Type' => 'text/csv']);
    }
}
