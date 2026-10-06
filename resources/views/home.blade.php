@extends('layouts.app')
@section('title', 'SMA Santo Paulus — Beriman, Berilmu, Berkarakter | PPDB 2026/2027')
@section('content')

{{-- HERO --}}
<section class="bg-gradient-to-br from-blue-950 via-blue-900 to-blue-800 text-white">
    <div class="max-w-7xl mx-auto px-4 py-14 lg:py-20 grid lg:grid-cols-2 gap-10 items-center">
        <div>
            <span class="inline-flex items-center gap-2 text-xs font-bold bg-white/15 border border-white/20 px-3 py-1.5 rounded-full">● PPDB 2026/2027 TELAH DIBUKA — Kuota 288 kursi</span>
            <h1 class="mt-4 text-3xl sm:text-4xl lg:text-5xl font-bold leading-tight">Beriman. Berilmu.<br>Siap Hadapi Masa Depan.</h1>
            <p class="mt-4 text-blue-100 text-sm sm:text-base max-w-xl">SMA Santo Paulus — Sekolah Katolik terakreditasi A. Membentuk generasi unggul dalam akademik, karakter, dan iman sejak 1965. 98% lulusan diterima PTN/PTS favorit.</p>
            <div class="mt-6 flex flex-col sm:flex-row gap-3">
                <a href="/ppdb#formulir" class="text-center px-6 py-3.5 bg-amber-400 text-slate-900 font-bold rounded-xl hover:bg-amber-300">Daftar PPDB Sekarang →</a>
                <a href="#keunggulan" class="text-center px-6 py-3.5 border border-white/30 rounded-xl hover:bg-white/10">Jelajahi Sekolah</a>
            </div>
            <p class="mt-3 text-xs text-blue-200">Pendaftaran 100% online • Tanpa antre • Dibantu panitia via WhatsApp</p>
            <div class="mt-6 flex gap-6 text-sm">
                <div><p class="text-2xl font-bold">1.240+</p><p class="text-blue-200 text-xs">Siswa Aktif</p></div>
                <div><p class="text-2xl font-bold">98%</p><p class="text-blue-200 text-xs">Lolos PTN/PTS</p></div>
                <div><p class="text-2xl font-bold">A</p><p class="text-blue-200 text-xs">Akreditasi (97)</p></div>
                <div><p class="text-2xl font-bold">120+</p><p class="text-blue-200 text-xs">Medali 3 Tahun</p></div>
            </div>
        </div>
        <div class="bg-white/10 border border-white/20 rounded-2xl p-4">
            <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=800&q=80&auto=format&fit=crop" alt="Suasana belajar SMA Santo Paulus" class="rounded-xl w-full h-64 sm:h-80 object-cover">
            <div class="grid grid-cols-2 gap-3 mt-3 text-sm">
                <div class="bg-white text-slate-900 rounded-xl p-3"><p class="font-bold">Smart Class & CBT</p><p class="text-xs text-slate-500">Ujian digital, nilai real-time</p></div>
                <div class="bg-white text-slate-900 rounded-xl p-3"><p class="font-bold">Beasiswa s.d 100%</p><p class="text-xs text-slate-500">Prestasi & afirmasi</p></div>
            </div>
        </div>
    </div>
</section>

{{-- SAMBUTAN KEPSEK --}}
<section class="max-w-7xl mx-auto px-4 py-12">
    <div class="bg-white border rounded-2xl p-6 sm:p-10 grid md:grid-cols-[200px_1fr] gap-8 items-start">
        <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?w=400&q=80&auto=format&fit=crop" alt="Kepala Sekolah" class="w-40 h-52 md:w-full md:h-64 object-cover rounded-xl mx-auto">
        <div>
            <p class="text-xs font-bold tracking-widest text-blue-800">SAMBUTAN KEPALA SEKOLAH</p>
            <h2 class="text-2xl sm:text-3xl font-bold mt-2">“Selamat Datang di Rumah Kedua Putra-Putri Anda.”</h2>
            <p class="mt-3 text-slate-600 text-sm sm:text-base leading-relaxed">Saya <b>Rm. Thomas Bintang, S.Pd.</b> — Setiap anak punya cahaya. Tugas kami menjaganya tetap menyala: lewat disiplin yang hangat, pembelajaran bermakna, dan komunitas yang peduli. Mari bertumbuh bersama kami.</p>
            <div class="mt-4 flex flex-wrap gap-3">
                <a href="/profil" class="px-5 py-2.5 bg-slate-900 text-white text-sm font-semibold rounded-xl">Baca Profil Lengkap →</a>
                <a href="/ppdb" class="px-5 py-2.5 border text-sm font-semibold rounded-xl">Tanya PPDB via WA</a>
            </div>
        </div>
    </div>
</section>

{{-- KEUNGGULAN --}}
<section id="keunggulan" class="max-w-7xl mx-auto px-4 pb-4">
    <h2 class="text-2xl sm:text-3xl font-bold text-center">Kenapa 1.200+ Keluarga Memilih Kami?</h2>
    <p class="text-center text-slate-500 text-sm mt-2">Fokus pada 4 hal yang paling ditanyakan orang tua: akademik, karakter, teknologi, biaya.</p>
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-8">
        @foreach([
            ['Kurikulum Merdeka + English','4 JP/minggu + pilihan Mandarin/Jerman. Proyek nyata tiap semester.','📚'],
            ['Pembinaan Karakter SERVIAM','Retreat, live-in, dan bakti sosial wajib. Disiplin hangat.','🤝'],
            ['Smart Class & E-Learning','Materi, tugas, CBT, dan kelas virtual dalam satu portal.','💻'],
            ['Beasiswa & Cicilan Ringan','Prestasi s.d 100%. Uang pangkal bisa dicicil 3x.','🎓'],
        ] as [$t,$d,$i])
        <div class="bg-white border rounded-2xl p-5">
            <div class="text-3xl">{{ $i }}</div>
            <p class="font-bold mt-3">{{ $t }}</p>
            <p class="text-sm text-slate-500 mt-1">{{ $d }}</p>
        </div>
        @endforeach
    </div>
</section>

{{-- BERITA + PENGUMUMAN --}}
<section class="max-w-7xl mx-auto px-4 py-12 grid lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-bold">Kabar Terbaru</h2>
            <a href="/berita" class="text-sm font-semibold text-blue-800">Lihat Semua →</a>
        </div>
        <div class="grid sm:grid-cols-3 gap-4 mt-4">
            <article class="bg-white border rounded-2xl overflow-hidden sm:col-span-1">
                <img src="https://images.unsplash.com/photo-1580582932707-520aed937b7b?w=600&q=80&auto=format&fit=crop" class="h-36 w-full object-cover" alt="Robotik juara">
                <div class="p-4"><span class="text-[11px] font-bold bg-green-100 text-green-800 px-2 py-1 rounded">PRESTASI</span><p class="font-bold text-sm mt-2">Tim Robotik Juara 1 Nasional 2026</p><p class="text-xs text-slate-500 mt-1">12 Feb 2026 • 2 mnt baca</p></div>
            </article>
            <article class="bg-white border rounded-2xl overflow-hidden">
                <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?w=600&q=80&auto=format&fit=crop" class="h-36 w-full object-cover" alt="Retreat">
                <div class="p-4"><span class="text-[11px] font-bold bg-blue-100 text-blue-800 px-2 py-1 rounded">KEGIATAN</span><p class="font-bold text-sm mt-2">Retreat Kelas X: Belajar Hening di Samadi</p><p class="text-xs text-slate-500 mt-1">5 Feb 2026 • 3 mnt baca</p></div>
            </article>
            <article class="bg-white border rounded-2xl overflow-hidden">
                <img src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=600&q=80&auto=format&fit=crop" class="h-36 w-full object-cover" alt="Ujian">
                <div class="p-4"><span class="text-[11px] font-bold bg-amber-100 text-amber-800 px-2 py-1 rounded">PENGUMUMAN</span><p class="font-bold text-sm mt-2">Jadwal Ujian Akhir Semester Genap</p><p class="text-xs text-slate-500 mt-1">1 Feb 2026 • Info resmi</p></div>
            </article>
        </div>
    </div>
    <aside class="bg-amber-50 border border-amber-200 rounded-2xl p-5">
        <p class="text-xs font-bold tracking-widest text-amber-800">⚠ PENGUMUMAN PENTING</p>
        <p class="font-bold mt-2">PPDB Gelombang 1 ditutup 20 Desember 2025</p>
        <p class="text-sm text-slate-600 mt-1">Kuota tersisa 40 kursi. Pendaftar Gelombang 1 bebas biaya formulir + prioritas beasiswa.</p>
        <a href="/ppdb#jadwal" class="mt-4 block text-center px-4 py-3 bg-slate-900 text-white text-sm font-bold rounded-xl">Lihat Jadwal Lengkap</a>
        <a href="/ppdb#faq" class="mt-2 block text-center px-4 py-3 border text-sm font-semibold rounded-xl bg-white">Tanya Jawab PPDB</a>
    </aside>
</section>

{{-- CTA PENUTUP --}}
<section class="max-w-7xl mx-auto px-4 pb-14">
    <div class="bg-blue-900 text-white rounded-2xl p-8 sm:p-12 text-center">
        <h2 class="text-2xl sm:text-3xl font-bold">Masih Ragu? Datang dan Rasakan Sendiri.</h2>
        <p class="text-blue-200 text-sm mt-2">Open House setiap Sabtu 09.00 — tur kelas, lab, dan konsultasi gratis dengan guru.</p>
        <div class="mt-6 flex flex-col sm:flex-row justify-center gap-3">
            <a href="/ppdb#formulir" class="px-6 py-3.5 bg-amber-400 text-slate-900 font-bold rounded-xl">Daftar PPDB →</a>
            <a href="#" class="px-6 py-3.5 border border-white/30 rounded-xl">Daftar Open House Gratis</a>
        </div>
    </div>
</section>

@endsection
