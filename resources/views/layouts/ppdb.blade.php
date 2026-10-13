<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title', 'PPDB SMA Swasta Santo Paulus Pontianak')</title>
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
<!-- Topbar -->
<div class="bg-navy-950 text-blue-100 text-xs">
<div class="max-w-6xl mx-auto px-4 py-1.5 flex justify-between">
<span>Jl. Arani No.1, Pontianak • Senin–Jumat 07.00–15.00 WIB</span>
<span class="hidden sm:block">WA Panitia: 08xx-xxxx-xxxx • Gelombang 1 dibuka!</span>
</div>
</div>
<!-- Navbar -->
<header class="bg-white/95 backdrop-blur sticky top-0 z-20 shadow-sm">
<div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">
<a href="{{ route('ppdb.home') }}" class="flex items-center gap-3">
<div class="w-11 h-11 rounded-xl bg-navy-900 text-gold-400 flex items-center justify-center font-extrabold text-lg shadow">SP</div>
<div>
<div class="font-extrabold text-navy-900 leading-tight">SMA Swasta Santo Paulus</div>
<div class="text-[11px] tracking-widest uppercase text-amber-600 font-bold">PPDB 2026/2027 • Pontianak</div>
</div>
</a>
<nav class="flex items-center gap-1 text-sm font-semibold">
<a href="{{ route('ppdb.home') }}" class="px-3 py-2 rounded-lg hover:bg-slate-100">Beranda</a>
<a href="{{ route('ppdb.daftar') }}" class="px-4 py-2 rounded-lg bg-navy-900 text-white hover:bg-navy-800 shadow">Daftar Sekarang</a>
<a href="{{ route('ppdb.cek.form') }}" class="px-3 py-2 rounded-lg hover:bg-slate-100">Cek Status</a>
<a href="{{ route('admin.login') }}" class="px-3 py-2 rounded-lg text-slate-500 hover:bg-slate-100">Admin</a>
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
<div class="max-w-6xl mx-auto px-4 py-8 grid md:grid-cols-3 gap-6 text-sm">
<div>
<div class="font-bold text-white mb-1">SMA Swasta Santo Paulus Pontianak</div>
<div class="text-blue-200 text-xs">Portal khusus PPDB — terpisah dari website utama sekolah yang rilis Desember. Nanti ditautkan via tombol PPDB Online.</div>
</div>
<div>
<div class="font-bold text-white mb-1">Kontak Panitia</div>
<div class="text-xs">Jl. Arani No.1, Pontianak<br>WA: 08xx-xxxx-xxxx<br>Email: ppdb@smasantopaulus.sch.id</div>
</div>
<div>
<div class="font-bold text-white mb-1">Jam Layanan</div>
<div class="text-xs">Senin–Jumat 07.00–15.00<br>Sabtu 08.00–12.00<br>Minggu/libur tutup</div>
</div>
</div>
<div class="border-t border-white/10 text-center text-[11px] py-3 text-blue-300">© 2026 PPDB Santo Paulus Pontianak • Dibuat dalam program magang</div>
</div>
</footer>
</body>
</html>
