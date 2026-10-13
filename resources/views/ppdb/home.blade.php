@extends('layouts.ppdb')
@section('title', 'SPMB 2027/2028 Santo Paulus')
@section('hero')
<section class="hero-bg text-white">
<div class="pattern">
<div class="max-w-6xl mx-auto px-4 py-14 md:py-20 grid md:grid-cols-2 gap-8 items-center">
<div>
<div class="inline-flex items-center gap-2 bg-white/15 border border-white/20 rounded-full px-3 py-1 text-xs mb-3">SPMB TA 2027/2028 • Online & Offline</div>
<h1 class="text-3xl md:text-5xl font-extrabold leading-tight">Daftar SPMB<br>Santo Paulus 2027/2028.</h1>
<p class="mt-3 text-blue-100 text-sm md:text-base">Transfer BNI 6617710032, isi form 4 langkah, upload berkas, terima Kartu Calon Peserta & masuk Grup WA Ortu. Offline juga bisa langsung ke sekolah.</p>
<div class="mt-5 flex flex-wrap gap-2">
<a href="{{ route('ppdb.daftar') }}" class="px-6 py-3 bg-gold-400 text-navy-950 font-extrabold rounded-xl shadow hover:bg-yellow-300">Daftar Online Sekarang</a>
<a href="{{ route('ppdb.biaya') }}" class="px-6 py-3 bg-white/15 border border-white/30 rounded-xl font-bold hover:bg-white/25">Cek Biaya/Gelombang</a>
</div>
<div class="mt-4 text-xs text-blue-200">Gel.1: 1 Okt–18 Des 2026 • Gel.2: 4 Jan–31 Mar 2027 (atau kuota terpenuhi)</div>
</div>
<div class="bg-white text-slate-800 rounded-2xl p-5 shadow-2xl">
<div class="font-extrabold text-navy-900">Statistik Pendaftar</div>
<div class="grid grid-cols-3 gap-3 mt-3 text-center">
<div class="bg-slate-50 rounded-xl p-3"><div class="text-2xl font-extrabold text-navy-900">{{ $stats['total'] }}</div><div class="text-[11px]">Total</div></div>
<div class="bg-green-50 rounded-xl p-3"><div class="text-2xl font-extrabold text-green-700">{{ $stats['diterima'] }}</div><div class="text-[11px]">Diterima</div></div>
<div class="bg-amber-50 rounded-xl p-3"><div class="text-2xl font-extrabold text-amber-600">{{ $stats['pending'] }}</div><div class="text-[11px]">Antre</div></div>
</div>
<div class="mt-3 text-xs bg-blue-50 border border-blue-100 rounded-xl p-3">Setelah daftar: simpan Kartu + bukti transfer untuk ukur seragam & masuk Grup WA Ortu.</div>
<div class="mt-2 grid grid-cols-3 gap-2 text-xs font-bold">
<a href="{{ route('ppdb.panduan') }}" class="p-2 bg-slate-100 rounded-lg text-center">Panduan</a>
<a href="{{ route('ppdb.biaya') }}" class="p-2 bg-slate-100 rounded-lg text-center">Biaya</a>
<a href="{{ route('ppdb.beasiswa') }}" class="p-2 bg-slate-100 rounded-lg text-center">Beasiswa</a>
</div>
</div>
</div>
</div>
</section>
@endsection
@section('content')
<div class="grid md:grid-cols-4 gap-4">
<div class="bg-white rounded-2xl p-5 shadow card-hover border-t-4 border-blue-900"><div class="font-bold">1. Transfer & Simpan Bukti</div><div class="text-sm text-slate-600 mt-1">BNI 6617710032 a.n. YPSB SMA STO PAULUS. Bukti diunggah di Step 4.</div></div>
<div class="bg-white rounded-2xl p-5 shadow card-hover border-t-4 border-amber-500"><div class="font-bold">2. Isi Form + Upload</div><div class="text-sm text-slate-600 mt-1">Akte, KK, KTP Ortu, Baptis/Pernyataan, Rapor Kls 8 Ganjil+Genap, Foto 3x4.</div></div>
<div class="bg-white rounded-2xl p-5 shadow card-hover border-t-4 border-green-600"><div class="font-bold">3. Kartu Peserta</div><div class="text-sm text-slate-600 mt-1">Kartu + bukti transfer untuk ukur seragam (vendor / WA).</div></div>
<div class="bg-white rounded-2xl p-5 shadow card-hover border-t-4 border-purple-600"><div class="font-bold">4. Grup WA Ortu</div><div class="text-sm text-slate-600 mt-1">Info terkini dari sekolah via grup. Cek status via nomor + tgl lahir.</div></div>
</div>
<div class="grid md:grid-cols-2 gap-4 mt-4">
<div class="rounded-2xl overflow-hidden shadow relative min-h-[260px] flex">
<img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?q=80&w=1200&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover" alt="Kegiatan">
<div class="absolute inset-0 bg-gradient-to-t from-navy-950 via-navy-900/60 to-transparent"></div>
<div class="relative p-5 text-white mt-auto text-sm"><div class="font-bold text-lg">Seragam & Fasilitas</div>Putih-Abu, Putih-Putih, Pramuka, Olahraga, Kaos Sabtu, Jas Almamater + 3 kaos kaki, dasi, cekak, kacu.</div>
</div>
<div class="bg-white rounded-2xl p-5 shadow text-sm">
<h2 class="font-extrabold text-navy-900 mb-2">Ringkasan Biaya 2027/2028</h2>
<ul class="space-y-1">
<li>Normal: DPP 8.000.000 + Seragam 3.025.000 + SPP Juli 725.000 = <b>11.750.000</b></li>
<li>Gel.1 YPSB (25%): <b>9.750.000</b> • Suster (15%): <b>10.550.000</b> • Umum (10%): <b>10.950.000</b></li>
<li>Gel.2 semua (10%): <b>10.950.000</b> • Lunas / Angsuran 2x, pelunasan maks 31 Jul 2027</li>
</ul>
<div class="mt-3 flex gap-2">
<a href="{{ route('ppdb.biaya') }}" class="px-4 py-2 bg-navy-900 text-white rounded-lg font-bold">Kalkulator Biaya</a>
<a href="{{ route('ppdb.panduan') }}" class="px-4 py-2 border rounded-lg">Alur Offline</a>
</div>
</div>
</div>
@endsection
