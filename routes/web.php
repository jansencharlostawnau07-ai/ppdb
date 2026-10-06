<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// === AREA PUBLIK: bisa dibuka calon murid tanpa akun ===
Route::get('/', fn() => view('home'));
Route::get('/ppdb', fn() => view('ppdb'));
Route::get('/profil', fn() => view('stub', ['title' => 'Profil Sekolah', 'desc' => 'Sejarah, Visi-Misi, Guru & Fasilitas — halaman menyusul.']));
Route::get('/akademik', fn() => view('stub', ['title' => 'Informasi Akademik', 'desc' => 'Kurikulum, Jurusan, Kalender & Tata Tertib — halaman menyusul.']));
Route::get('/berita', fn() => view('stub', ['title' => 'Galeri & Berita', 'desc' => 'Kegiatan, Prestasi, Pengumuman + Galeri foto/video — halaman menyusul.']));
Route::get('/e-learning', fn() => view('elearning.index'));

// === PILIH PERAN ===
Route::get('/login', function (Request $request) {
    return $request->session()->has('user') ? redirect('/dashboard') : view('auth.gate');
});
Route::get('/login/siswa', function (Request $request) {
    return $request->session()->has('user') ? redirect('/dashboard') : view('auth.login-siswa');
});
Route::get('/login/guru', function (Request $request) {
    return $request->session()->has('user') ? redirect('/dashboard') : view('auth.login-guru');
});

Route::post('/login/siswa', function (Request $request) {
    $request->validate(['nis' => 'required', 'password' => 'required']);
    if ($request->nis === '20261001' && $request->password === 'siswa123') {
        $request->session()->put('user', ['role' => 'siswa', 'name' => 'Bintang (Murid)', 'nis' => '20261001']);
        return redirect('/dashboard');
    }
    return back()->withErrors(['login' => 'NIS atau password salah. Coba demo: 20261001 / siswa123'])->withInput();
});

Route::post('/login/guru', function (Request $request) {
    $request->validate(['nip' => 'required', 'password' => 'required', 'pin' => 'required']);
    if ($request->nip === '19850101' && $request->password === 'guru123' && $request->pin === '1234') {
        $request->session()->put('user', ['role' => 'guru', 'name' => 'Bpk. Bintang (Guru)', 'nip' => '19850101']);
        return redirect('/dashboard');
    }
    return back()->withErrors(['login' => 'NIP / password / PIN salah. Coba demo: 19850101 / guru123 / 1234'])->withInput();
});

Route::post('/logout', function (Request $request) {
    $request->session()->forget('user');
    return redirect('/');
});

// === AREA PRIVAT: hanya setelah login (nilai, materi, dashboard) ===
Route::middleware('auth.gate')->group(function () {
    Route::get('/dashboard', function (Request $request) {
        return view('dashboard', ['user' => $request->session()->get('user')]);
    });
    // Nanti: /e-learning/siswa/dashboard, /e-learning/guru/dashboard, /nilai, dsb. taruh di sini
});
