<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'SMA Santo Paulus — Beriman, Berilmu, Berkarakter')</title>
    <meta name="description" content="@yield('meta_desc', 'Website resmi SMA Santo Paulus: Profil, PPDB online, Akademik, Berita, Galeri, dan E-Learning. Terakreditasi A.')">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    @endif
</head>
<body class="bg-slate-50 text-slate-900 font-sans antialiased">

    {{-- Topbar pengumuman --}}
    <div class="bg-amber-400 text-slate-900 text-xs sm:text-sm">
        <div class="max-w-7xl mx-auto px-4 py-2 flex items-center justify-center gap-2 text-center">
            <span class="inline-block font-bold bg-slate-900 text-white text-[11px] px-2 py-0.5 rounded">PPDB 2026/2027 DIBUKA</span>
            <p class="truncate">Gelombang 1: bebas biaya formulir s.d 20 Des 2025 — <a href="/ppdb" class="underline font-semibold">Lihat Jadwal</a></p>
        </div>
    </div>

    {{-- Header sticky + responsif --}}
    <header class="sticky top-0 z-50 bg-white/95 backdrop-blur border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <a href="/" class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-900 text-white flex items-center justify-center font-bold text-lg">SP</div>
                    <div class="leading-tight">
                        <p class="font-bold text-sm sm:text-base">SMA Santo Paulus</p>
                        <p class="text-[11px] sm:text-xs text-slate-500">Beriman • Berilmu • Berkarakter • Akreditasi A</p>
                    </div>
                </a>

                {{-- Desktop nav --}}
                <nav class="hidden lg:flex items-center gap-1 text-sm font-medium">
                    <a href="/" class="px-3 py-2 rounded-lg hover:bg-slate-100 {{ request()->is('/') ? 'text-blue-800 bg-blue-50' : '' }}">Beranda</a>
                    <div class="relative group">
                        <a href="/profil" class="px-3 py-2 rounded-lg hover:bg-slate-100 flex items-center gap-1">Profil ▾</a>
                        <div class="absolute hidden group-hover:block top-full left-0 w-56 bg-white border rounded-xl shadow-lg p-2">
                            <a href="/profil#sejarah" class="block px-3 py-2 rounded-lg hover:bg-slate-100">Sejarah</a>
                            <a href="/profil#visi-misi" class="block px-3 py-2 rounded-lg hover:bg-slate-100">Visi & Misi</a>
                            <a href="/profil#guru" class="block px-3 py-2 rounded-lg hover:bg-slate-100">Guru & Tendik</a>
                            <a href="/profil#fasilitas" class="block px-3 py-2 rounded-lg hover:bg-slate-100">Fasilitas</a>
                        </div>
                    </div>
                    <a href="/ppdb" class="px-3 py-2 rounded-lg hover:bg-slate-100 {{ request()->is('ppdb*') ? 'text-blue-800 bg-blue-50' : '' }}">PPDB <span class="ml-1 text-[10px] bg-red-600 text-white px-1.5 py-0.5 rounded-full">Baru</span></a>
                    <div class="relative group">
                        <a href="/akademik" class="px-3 py-2 rounded-lg hover:bg-slate-100 flex items-center gap-1">Akademik ▾</a>
                        <div class="absolute hidden group-hover:block top-full left-0 w-60 bg-white border rounded-xl shadow-lg p-2">
                            <a href="/akademik#kurikulum" class="block px-3 py-2 rounded-lg hover:bg-slate-100">Kurikulum</a>
                            <a href="/akademik#jurusan" class="block px-3 py-2 rounded-lg hover:bg-slate-100">Jurusan & Ekskul</a>
                            <a href="/akademik#kalender" class="block px-3 py-2 rounded-lg hover:bg-slate-100">Kalender Akademik</a>
                            <a href="/akademik#tata-tertib" class="block px-3 py-2 rounded-lg hover:bg-slate-100">Tata Tertib</a>
                        </div>
                    </div>
                    <a href="/berita" class="px-3 py-2 rounded-lg hover:bg-slate-100">Galeri & Berita</a>
                    <a href="/e-learning" class="px-3 py-2 rounded-lg hover:bg-slate-100">E-Learning</a>
                </nav>

                <div class="hidden lg:flex items-center gap-2">
                    @if(session('user'))
                        <a href="/dashboard" class="text-xs px-3 py-2 bg-slate-100 rounded-xl">👤 {{ session('user.name') }} • {{ strtoupper(session('user.role')) }}</a>
                        <form method="POST" action="/logout" class="inline">@csrf<button class="px-4 py-2 text-sm border rounded-xl hover:bg-red-50 hover:text-red-700">Keluar</button></form>
                    @else
                        <a href="/login/siswa" class="px-4 py-2 text-sm border rounded-xl hover:bg-slate-100">Masuk Murid</a>
                        <a href="/login/guru" class="px-4 py-2 text-sm border rounded-xl hover:bg-slate-100">Masuk Guru</a>
                    @endif
                    <a href="/ppdb#formulir" class="px-4 py-2 text-sm font-bold bg-blue-800 text-white rounded-xl hover:bg-blue-900">Daftar PPDB →</a>
                </div>

                {{-- Mobile hamburger --}}
                <button id="menuBtn" class="lg:hidden p-2 rounded-lg border" aria-label="Buka menu">☰</button>
            </div>
        </div>

        {{-- Mobile drawer --}}
        <nav id="mobileMenu" class="hidden lg:hidden border-t bg-white px-4 py-3 space-y-1 text-sm font-medium">
            <a href="/" class="block px-3 py-2.5 rounded-lg bg-slate-50">Beranda</a>
            <a href="/profil" class="block px-3 py-2.5 rounded-lg hover:bg-slate-50">Profil Sekolah</a>
            <a href="/ppdb" class="block px-3 py-2.5 rounded-lg hover:bg-slate-50">PPDB — Pendaftaran Baru</a>
            <a href="/akademik" class="block px-3 py-2.5 rounded-lg hover:bg-slate-50">Informasi Akademik</a>
            <a href="/berita" class="block px-3 py-2.5 rounded-lg hover:bg-slate-50">Galeri & Berita</a>
            <a href="/e-learning" class="block px-3 py-2.5 rounded-lg hover:bg-slate-50">E-Learning (Siswa & Guru)</a>
            <div class="flex gap-2 pt-2">
                <a href="/ppdb#formulir" class="flex-1 text-center px-4 py-3 font-bold bg-blue-800 text-white rounded-xl">Daftar PPDB</a>
                <a href="/profil" class="flex-1 text-center px-4 py-3 border rounded-xl">Jelajahi Sekolah</a>
            </div>
            @if(session('user'))
            <a href="/dashboard" class="block text-center py-3 text-sm bg-slate-900 text-white rounded-xl">Dashboard ({{ session('user.name') }})</a>
            <form method="POST" action="/logout" class="pt-1">@csrf<button class="w-full py-3 text-sm border border-red-200 text-red-700 rounded-xl">Keluar</button></form>
            @else
            <div class="flex gap-2 pt-1">
                <a href="/login/siswa" class="flex-1 text-center py-3 text-sm border rounded-xl">Masuk Murid</a>
                <a href="/login/guru" class="flex-1 text-center py-3 text-sm border rounded-xl">Masuk Guru</a>
            </div>
            @endif
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-slate-900 text-slate-200 mt-16">
        <div class="max-w-7xl mx-auto px-4 py-12 grid gap-10 md:grid-cols-4">
            <div>
                <p class="font-bold text-white">SMA Santo Paulus</p>
                <p class="text-sm mt-2 text-slate-400">Jl. Pendidikan No. 45, Yogyakarta<br>Senin–Jumat 07.00–15.00<br>(0274) 123-456 • info@smasantopaulus.sch.id</p>
                <div class="flex gap-2 mt-4 text-sm">
                    <a href="#" class="px-3 py-1.5 bg-white/10 rounded-lg">IG</a>
                    <a href="#" class="px-3 py-1.5 bg-white/10 rounded-lg">YT</a>
                    <a href="#" class="px-3 py-1.5 bg-white/10 rounded-lg">FB</a>
                    <a href="#" class="px-3 py-1.5 bg-white/10 rounded-lg">WA</a>
                </div>
            </div>
            <div class="text-sm">
                <p class="font-bold text-white mb-3">Jelajah</p>
                <ul class="space-y-2">
                    <li><a href="/profil" class="hover:underline">Profil Sekolah</a></li>
                    <li><a href="/ppdb" class="hover:underline">PPDB Online</a></li>
                    <li><a href="/akademik" class="hover:underline">Kalender Akademik</a></li>
                    <li><a href="/berita" class="hover:underline">Berita & Galeri</a></li>
                </ul>
            </div>
            <div class="text-sm">
                <p class="font-bold text-white mb-3">Bantuan Cepat</p>
                <ul class="space-y-2">
                    <li><a href="/ppdb#faq" class="hover:underline">FAQ PPDB</a></li>
                    <li><a href="/e-learning#panduan-siswa" class="hover:underline">Panduan E-Learning</a></li>
                    <li><a href="#" class="hover:underline">Unduh Brosur PPDB (PDF)</a></li>
                    <li><a href="#" class="hover:underline">Hubungi Panitia via WA</a></li>
                </ul>
            </div>
            <div class="text-sm">
                <p class="font-bold text-white mb-3">Jam Layanan PPDB</p>
                <p class="text-slate-400">Setiap hari kerja 08.00–15.00.<br>Respon &lt; 5 menit di jam kerja.</p>
                <a href="/ppdb#formulir" class="inline-block mt-4 px-4 py-2.5 bg-amber-400 text-slate-900 font-bold rounded-xl">Daftar Sekarang →</a>
            </div>
        </div>
        <div class="border-t border-white/10 text-center text-xs py-4 text-slate-400">© 2026 SMA Santo Paulus • Akreditasi A • NPSN 12345678</div>
    </footer>

    {{-- Sticky mobile CTA --}}
    <div class="lg:hidden fixed bottom-0 inset-x-0 z-50 bg-white/95 backdrop-blur border-t p-3 flex gap-2">
        <a href="/profil" class="flex-1 text-center py-3 border rounded-xl text-sm font-semibold">Jelajahi Sekolah</a>
        <a href="/ppdb#formulir" class="flex-1 text-center py-3 bg-blue-800 text-white rounded-xl text-sm font-bold">Daftar PPDB</a>
    </div>
    <div class="h-16 lg:hidden"></div>

    <script>
        document.getElementById('menuBtn')?.addEventListener('click', () => {
            document.getElementById('mobileMenu')?.classList.toggle('hidden');
        });
        // FAQ accordion sederhana
        document.querySelectorAll('[data-faq-btn]')?.forEach(btn => {
            btn.addEventListener('click', () => {
                const panel = btn.nextElementSibling;
                const open = !panel.classList.contains('hidden');
                document.querySelectorAll('[data-faq-panel]').forEach(p => p.classList.add('hidden'));
                if (!open) panel.classList.remove('hidden');
            });
        });
    </script>
</body>
</html>
