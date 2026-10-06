@extends('layouts.app')
@section('title', 'E-Learning — Portal Siswa & Guru SMA Santo Paulus')
@section('content')

{{-- HERO LANDING --}}
<section class="bg-gradient-to-br from-slate-900 via-blue-950 to-blue-900 text-white">
    <div class="max-w-7xl mx-auto px-4 py-12 text-center">
        <p class="text-xs font-bold tracking-widest text-amber-300">PORTAL PEMBELAJARAN DIGITAL</p>
        <h1 class="text-3xl sm:text-4xl font-bold mt-2">Satu Pintu untuk Belajar & Mengajar.</h1>
        @if(session('user'))
            <p class="text-emerald-300 text-sm sm:text-base mt-3 max-w-2xl mx-auto font-semibold">✅ Kamu sudah masuk sebagai {{ session('user.name') }} ({{ strtoupper(session('user.role')) }}) — tidak perlu login lagi.</p>
        @else
            <p class="text-slate-300 text-sm sm:text-base mt-3 max-w-2xl mx-auto">Pilih portal sesuai peranmu. Akun dibagikan saat MPLS (siswa) atau via Admin IT (guru).</p>
        @endif
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 -mt-6">
    @if(session('user'))
    {{-- SUDAH LOGIN: langsung masuk, tanpa login ulang --}}
    <div class="{{ session('user.role') === 'guru' ? 'bg-slate-900 text-white border-slate-900' : 'bg-white border-blue-200' }} border-2 rounded-3xl p-6 sm:p-8">
        <div class="flex flex-col sm:flex-row sm:items-center gap-4">
            <div class="text-4xl">{{ session('user.role') === 'guru' ? '👩‍🏫' : '🎒' }}</div>
            <div class="flex-1">
                <p class="text-xs font-bold tracking-widest {{ session('user.role') === 'guru' ? 'text-emerald-300' : 'text-blue-800' }}">SESI AKTIF • {{ strtoupper(session('user.role')) }}</p>
                <h2 class="text-2xl font-bold mt-1">Halo, {{ session('user.name') }}!</h2>
                <p class="text-sm mt-1 {{ session('user.role') === 'guru' ? 'text-slate-400' : 'text-slate-500' }}">
                    @if(session('user.role') === 'siswa')
                        NIS <b>{{ session('user.nis') }}</b> dikenali — materi, tugas, CBT & kelas virtual sudah terbuka. Tidak perlu memasukkan NIS lagi.
                    @else
                        NIP <b>{{ session('user.nip') }}</b> dikenali — kelas, penilaian & bank soal CBT sudah terbuka. Tidak perlu memasukkan NIP/PIN lagi.
                    @endif
                </p>
            </div>
            <div class="flex flex-col gap-2 sm:w-64">
                <a href="/dashboard" class="text-center px-5 py-3.5 font-bold rounded-xl {{ session('user.role') === 'guru' ? 'bg-emerald-500 text-slate-900 hover:bg-emerald-400' : 'bg-blue-800 text-white hover:bg-blue-900' }}">Lanjut ke Dashboard →</a>
                <form method="POST" action="/logout">@csrf<button class="w-full px-5 py-3 border rounded-xl text-sm font-semibold {{ session('user.role') === 'guru' ? 'border-white/20' : '' }}">Keluar / Ganti akun</button></form>
            </div>
        </div>
    </div>
    @else
    {{-- BELUM LOGIN: pilih peran --}}
    <div class="grid md:grid-cols-2 gap-5">
        {{-- Card Siswa --}}
        <div class="bg-white border-2 border-blue-200 rounded-3xl p-6 sm:p-8 relative overflow-hidden">
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-blue-100 rounded-full"></div>
            <div class="relative">
                <span class="text-4xl">🎒</span>
                <h2 class="text-2xl font-bold mt-2">Portal Siswa</h2>
                <p class="text-sm text-slate-500 mt-1">Materi 24/7 • Tugas online • Nilai real-time • Kelas virtual</p>
                <ul class="text-sm mt-4 space-y-1.5">
                    <li>✅ Login pakai <b>NIS + password</b></li>
                    <li>✅ Lihat deadline tugas & jadwal besok</li>
                    <li>✅ Bisa dari HP — ringan & hemat kuota</li>
                </ul>
                <div class="mt-5 flex flex-col sm:flex-row gap-2">
                    <a href="/login/siswa" class="flex-1 text-center px-5 py-3.5 bg-blue-800 text-white font-bold rounded-xl hover:bg-blue-900">Masuk sebagai Siswa →</a>
                    <a href="#panduan-siswa" class="px-5 py-3.5 border rounded-xl text-sm font-semibold text-center">Panduan 3 menit</a>
                </div>
                <p class="text-xs text-slate-400 mt-3">Contoh demo: NIS <code class="bg-slate-100 px-1 rounded">20261001</code> • password <code class="bg-slate-100 px-1 rounded">siswa123</code></p>
            </div>
        </div>

        {{-- Card Guru --}}
        <div class="bg-slate-900 text-white border-2 border-slate-900 rounded-3xl p-6 sm:p-8 relative overflow-hidden">
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-emerald-500/20 rounded-full"></div>
            <div class="relative">
                <span class="text-4xl">👩‍🏫</span>
                <h2 class="text-2xl font-bold mt-2">Portal Guru & Tendik</h2>
                <p class="text-sm text-slate-400 mt-1">Kelola materi • Nilai tugas • Bank soal CBT • Presensi digital</p>
                <ul class="text-sm mt-4 space-y-1.5 text-slate-200">
                    <li>🔒 Login pakai <b>NIP + password + PIN sekolah</b></li>
                    <li>📊 Dashboard: tugas belum dinilai & kehadiran</li>
                    <li>🛡️ Riwayat login tercatat — aman untuk CBT</li>
                </ul>
                <div class="mt-5 flex flex-col sm:flex-row gap-2">
                    <a href="/login/guru" class="flex-1 text-center px-5 py-3.5 bg-emerald-500 text-slate-900 font-bold rounded-xl hover:bg-emerald-400">Masuk sebagai Guru →</a>
                    <a href="#bantuan" class="px-5 py-3.5 border border-white/20 rounded-xl text-sm font-semibold text-center">Hubungi Admin IT</a>
                </div>
                <p class="text-xs text-slate-400 mt-3">Akses guru hanya via akun resmi. Lupa PIN? Hubungi Admin IT.</p>
            </div>
        </div>
    </div>
    @endif

    {{-- FITUR --}}
    <section class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-10">
        @foreach([
            ['📖','Materi Akses 24/7','Slide, video, e-book per mapel. Unduh untuk offline.'],
            ['📝','Tugas Online','Kumpulkan foto/PDF, cek nilai + komentar guru langsung.'],
            ['💻','Ujian / CBT','Tryout & ulangan aman: acak soal, timer, anti-sontek.'],
            ['🎥','Kelas Virtual','Jadwal Zoom/Meet terintegrasi kalender + pengingat WA.'],
        ] as [$i,$t,$d])
        <div class="bg-white border rounded-2xl p-5"><div class="text-3xl">{{ $i }}</div><p class="font-bold mt-2">{{ $t }}</p><p class="text-sm text-slate-500 mt-1">{{ $d }}</p></div>
        @endforeach
    </section>

    {{-- PANDUAN SISWA BARU + BANTUAN --}}
    <div class="grid lg:grid-cols-2 gap-5 mt-8 mb-14">
        <section id="panduan-siswa" class="bg-blue-50 border border-blue-100 rounded-2xl p-6">
            <h2 class="font-bold text-lg">Panduan Siswa Baru (3 Langkah)</h2>
            <ol class="text-sm mt-3 space-y-2.5">
                <li><b>1. Terima akun saat MPLS</b> — dari wali kelas: NIS + password awal.</li>
                <li><b>2. Login perdana</b> di <a href="/login/siswa" class="underline font-semibold">portal siswa</a> lalu ganti password.</li>
                <li><b>3. Ikuti orientasi 30 menit</b> — video di bawah + coba kumpulkan tugas demo.</li>
            </ol>
            <div class="mt-4 aspect-video bg-slate-900 text-white rounded-xl flex items-center justify-center text-sm">▶ Video Tutorial 3 Menit (embed YouTube di sini)</div>
            <a href="#" class="mt-3 inline-block px-4 py-2.5 bg-white border text-sm font-semibold rounded-xl">Unduh Panduan PDF</a>
        </section>
        <section id="bantuan" class="bg-white border rounded-2xl p-6">
            <h2 class="font-bold text-lg">Kendala Login?</h2>
            <ul class="text-sm mt-3 space-y-2 text-slate-600">
                <li>• <b>Siswa:</b> klik <i>Lupa Password</i> di halaman login → reset via WA orang tua terdaftar.</li>
                <li>• <b>Guru:</b> reset hanya via Admin IT (bawa SK mengajar).</li>
                <li>• <b>Helpdesk IT:</b> 0812-3456-7890 (Senin–Jumat 07.00–15.00) • helpdesk@smasantopaulus.sch.id</li>
            </ul>
            <div class="mt-4 flex gap-2">
                @if(session('user'))
                    <a href="/dashboard" class="flex-1 text-center px-4 py-3 bg-slate-900 text-white text-sm font-bold rounded-xl">Lanjut ke Dashboard →</a>
                    <form method="POST" action="/logout" class="flex-1">@csrf<button class="w-full px-4 py-3 border text-sm font-bold rounded-xl">Keluar</button></form>
                @else
                    <a href="/login/siswa" class="flex-1 text-center px-4 py-3 bg-slate-900 text-white text-sm font-bold rounded-xl">Login Siswa</a>
                    <a href="/login/guru" class="flex-1 text-center px-4 py-3 border text-sm font-bold rounded-xl">Login Guru</a>
                @endif
            </div>
        </section>
    </div>
</div>
@endsection
