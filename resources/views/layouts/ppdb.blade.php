<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title', 'SPMB SMA Santo Paulus Pontianak 2027/2028')</title>
<script src="https://cdn.tailwindcss.com"></script>
<script>
tailwind.config = {
  theme: { extend: {
    colors: { navy: {800:'#1e3a8a',900:'#172e6e',950:'#0f204d'}, gold:{400:'#fbbf24',500:'#f59e0b'} },
    fontFamily: { sans: ['Plus Jakarta Sans','Inter','system-ui','sans-serif'] }
  }}
}
</script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
body{font-family:'Plus Jakarta Sans',system-ui,sans-serif}
.hero-bg{
 background-image: linear-gradient(rgba(15,32,77,.88), rgba(15,32,77,.72)), url('https://images.unsplash.com/photo-1562774053-701939374585?q=80&w=1600&auto=format&fit=crop');
 background-size:cover; background-position:center;
}
.pattern{background-image:radial-gradient(rgba(255,255,255,.18) 1px, transparent 1px); background-size:18px 18px}
.card-hover{transition:.2s} .card-hover:hover{transform:translateY(-3px); box-shadow:0 12px 30px rgba(15,32,77,.15)}
</style>
</head>
<body class="bg-slate-100 text-slate-800 min-h-screen flex flex-col">
<div class="bg-navy-950 text-blue-100 text-xs">
<div class="max-w-6xl mx-auto px-4 py-1.5 flex justify-between">
<span>SPMB 2027/2028 • Gel.1: 1 Okt–18 Des 2026 • Gel.2: 4 Jan–31 Mar 2027</span>
<span class="hidden sm:block">Rekening BNI disamarkan — lihat full di form pendaftaran</span>
</div>
</div>
<header class="bg-white/95 backdrop-blur sticky top-0 z-20 shadow-sm">
<div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">
<a href="{{ route('ppdb.home') }}" class="flex items-center gap-3">
<img src="{{ asset('images/logo-sekolah.png') }}" alt="Logo SMA Santo Paulus" class="w-11 h-11 rounded-xl bg-white object-contain shadow p-1">
<div>
<div class="font-extrabold text-navy-900 leading-tight">SMA Santo Paulus Pontianak</div>
<div class="text-[11px] tracking-widest uppercase text-amber-600 font-bold">SPMB 2027/2028</div>
</div>
</a>
<nav class="flex items-center gap-1 text-sm font-semibold flex-wrap">
<a href="{{ route('ppdb.home') }}" class="px-3 py-2 rounded-lg hover:bg-slate-100">Beranda</a>
<a href="{{ route('ppdb.panduan') }}" class="px-3 py-2 rounded-lg hover:bg-slate-100">Panduan</a>
<a href="{{ route('ppdb.biaya') }}" class="px-3 py-2 rounded-lg hover:bg-slate-100">Biaya</a>
<a href="{{ route('ppdb.beasiswa') }}" class="px-3 py-2 rounded-lg hover:bg-slate-100">Beasiswa</a>
@auth
<a href="{{ route('admin.dashboard') }}" class="px-3 py-2 rounded-lg bg-green-100 text-green-800">Dashboard Admin</a>
<form method="POST" action="{{ route('admin.logout') }}" class="inline">@csrf<button class="px-3 py-2 rounded-lg bg-red-100 text-red-700">Logout</button></form>
@else
<a href="{{ route('ppdb.daftar') }}" class="px-4 py-2 rounded-lg bg-navy-900 text-white hover:bg-navy-800 shadow">Daftar</a>
<a href="{{ route('ppdb.cek.form') }}" class="px-3 py-2 rounded-lg hover:bg-slate-100">Cek Status</a>
@endauth
</nav>
</div>
</header>
<main class="flex-1">
@hasSection('hero')
@yield('hero')
@endif
<div class="max-w-6xl mx-auto px-4 py-6">
@if(session('success'))
<div class="mb-4 p-3 rounded-xl bg-green-100 border border-green-300 text-green-800">{{ session('success') }}</div>
@endif
@if($errors->any())
<div class="mb-4 p-3 rounded-xl bg-red-100 border border-red-300 text-red-800">
<ul class="list-disc ml-5">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
</div>
@endif
@yield('content')
</div>
</main>
<footer class="mt-6">
<div class="bg-navy-950 text-blue-100">
<div class="max-w-6xl mx-auto px-4 py-8 grid md:grid-cols-4 gap-6 text-sm">
<div>
<div class="font-bold text-white mb-1">SPMB 2027/2028</div>
<div class="text-blue-200 text-xs">Online via portal ini (pengganti bit.ly/SPMBSMAPAULUSPTK) & offline langsung di sekolah. Portal khusus SPMB, ditautkan ke web utama Desember.</div>
</div>
<div>
<div class="font-bold text-white mb-1">Rekening</div>
<div class="text-xs">BNI 6617••••32<br>a.n. YPSB SMA STO PAULUS<br>Nomor lengkap tampil di form pendaftaran + konfirmasi WA panitia.</div>
</div>
<div>
<div class="font-bold text-white mb-1">Panitia (WA)</div>
<div class="text-xs">Yuliana: 0812-5792-8672<br>Suliono: 0896-9351-3031<br>Leo: 0813-1759-9957<br>Lenny (Beasiswa): 0812-5036-8308</div>
</div>
<div>
<div class="font-bold text-white mb-1">Batas Pelunasan</div>
<div class="text-xs">Angsuran II / pelunasan maks 31 Juli 2027. Tidak lunas = dianggap mengundurkan diri & hangus.</div>
</div>
</div>
<div class="border-t border-white/10 text-center text-[11px] py-3 text-blue-300">© 2027 SPMB Santo Paulus Pontianak</div>
</div>
</footer>
</body>
</html>
