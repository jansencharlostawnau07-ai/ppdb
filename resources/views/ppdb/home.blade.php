@extends('layouts.ppdb')
@section('title', 'Beranda PPDB Santo Paulus')
@section('hero')
<section class="hero-bg text-white">
<div class="pattern">
<div class="max-w-6xl mx-auto px-4 py-14 md:py-20 grid md:grid-cols-2 gap-8 items-center">
<div>
<div class="inline-flex items-center gap-2 bg-white/15 border border-white/20 rounded-full px-3 py-1 text-xs mb-3">Tahun Ajaran 2026/2027 • Gelombang 1–3 dibuka</div>
<h1 class="text-3xl md:text-5xl font-extrabold leading-tight">Sekolah Unggul,<br>Berkarakter & Beriman.</h1>
<p class="mt-3 text-blue-100 text-sm md:text-base">Daftar online tanpa antre — isi formulir 5 menit, upload berkas dari HP, pantau status kelulusan secara transparan. Pengganti sistem manual & Google Form.</p>
<div class="mt-5 flex flex-wrap gap-2">
<a href="{{ route('ppdb.daftar') }}" class="px-6 py-3 bg-gold-400 text-navy-950 font-extrabold rounded-xl shadow hover:bg-yellow-300">Daftar Sekarang →</a>
<a href="{{ route('ppdb.cek.form') }}" class="px-6 py-3 bg-white/15 border border-white/30 rounded-xl font-bold hover:bg-white/25">Cek Status</a>
</div>
<div class="mt-4 text-xs text-blue-200">Sudah ada website utama? Portal ini khusus PPDB dan akan ditautkan Desember nanti.</div>
</div>
<div class="bg-white text-slate-800 rounded-2xl p-5 shadow-2xl">
<div class="font-extrabold text-navy-900">Statistik Pendaftar Hari Ini</div>
<div class="grid grid-cols-3 gap-3 mt-3 text-center">
<div class="bg-slate-50 rounded-xl p-3"><div class="text-2xl font-extrabold text-navy-900">{{ $stats['total'] }}</div><div class="text-[11px]">Total</div></div>
<div class="bg-green-50 rounded-xl p-3"><div class="text-2xl font-extrabold text-green-700">{{ $stats['diterima'] }}</div><div class="text-[11px]">Diterima</div></div>
<div class="bg-amber-50 rounded-xl p-3"><div class="text-2xl font-extrabold text-amber-600">{{ $stats['pending'] }}</div><div class="text-[11px]">Antre</div></div>
</div>
<div class="mt-3 text-xs bg-blue-50 border border-blue-100 rounded-xl p-3">Nomor pendaftaran contoh: <b>PPDB-2026-0001</b><br>Simpan nomor + tanggal lahir untuk cek status.</div>
</div>
</div>
</div>
</section>
@endsection
@section('content')
<div class="grid md:grid-cols-3 gap-4 -mt-2">
<div class="bg-white rounded-2xl p-5 shadow card-hover border-t-4 border-blue-900"><div class="text-3xl">📝</div><div class="font-bold mt-1">1. Isi Formulir</div><div class="text-sm text-slate-600">Data siswa, ortu, asal sekolah, jalur Reguler/Prestasi/Afirmasi.</div></div>
<div class="bg-white rounded-2xl p-5 shadow card-hover border-t-4 border-amber-500"><div class="text-3xl">📤</div><div class="font-bold mt-1">2. Upload Berkas</div><div class="text-sm text-slate-600">KK, Akta, Rapor, Foto langsung dari HP (jpg/pdf, maks 2MB).</div></div>
<div class="bg-white rounded-2xl p-5 shadow card-hover border-t-4 border-green-600"><div class="text-3xl">🔍</div><div class="font-bold mt-1">3. Pantau Status</div><div class="text-sm text-slate-600">Verifikasi maks 3 hari kerja. Lolos → daftar ulang bawa berkas asli.</div></div>
</div>

<div class="grid md:grid-cols-2 gap-4 mt-4">
<div class="rounded-2xl overflow-hidden shadow relative min-h-[260px] flex">
<img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?q=80&w=1200&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover" alt="Kegiatan sekolah">
<div class="absolute inset-0 bg-gradient-to-t from-navy-950 via-navy-900/60 to-transparent"></div>
<div class="relative p-5 text-white mt-auto text-sm"><div class="font-bold text-lg">Kenapa Santo Paulus?</div>Disiplin, pembinaan karakter, ekstrakurikuler aktif, dan pendampingan guru. Foto ilustrasi — dapat diganti foto asli sekolah.</div>
</div>
<div class="bg-white rounded-2xl p-5 shadow text-sm">
<h2 class="font-extrabold text-navy-900 mb-2">Syarat & Jadwal</h2>
<ul class="space-y-2">
<li class="flex gap-2"><span class="bg-blue-100 rounded px-2">✓</span> Lulusan SMP/MTs 2024–2026</li>
<li class="flex gap-2"><span class="bg-blue-100 rounded px-2">✓</span> KK, Akta, Rapor sem. 1–5, pas foto 3x4</li>
<li class="flex gap-2"><span class="bg-blue-100 rounded px-2">✓</span> Gelombang 1: Jan–Mar • 2: Apr–Jun • 3: Jul*</li>
<li class="flex gap-2"><span class="bg-blue-100 rounded px-2">✓</span> Biaya formulir & daftar ulang via WA panitia</li>
</ul>
<div class="mt-4 flex gap-2">
<a href="{{ route('ppdb.daftar') }}" class="px-4 py-2 bg-navy-900 text-white rounded-lg font-bold">Mulai Daftar</a>
<span class="text-xs text-slate-500 self-center">* Gel. 3 dibuka jika kuota tersisa</span>
</div>
</div>
</div>
@endsection
