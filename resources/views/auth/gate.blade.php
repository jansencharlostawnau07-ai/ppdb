<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk — SMA Santo Paulus</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="min-h-screen bg-slate-950 text-white flex items-center justify-center p-4">
<div class="w-full max-w-3xl text-center">
    <div class="w-16 h-16 mx-auto rounded-2xl bg-white text-slate-900 flex items-center justify-center font-bold text-2xl">SP</div>
    <p class="text-xs tracking-widest text-amber-300 font-bold mt-4">SMA SANTO PAULUS • BERIMAN • BERILMU • BERKARAKTER</p>
    <h1 class="text-3xl sm:text-4xl font-bold mt-2">Masuk untuk Melanjutkan</h1>
    <p class="text-slate-400 text-sm mt-2">Halaman pertama ini hanya pintu masuk. Pilih peranmu untuk membuka Beranda dan semua menu.</p>

    @if(session('error'))
        <div class="mt-4 bg-red-500/15 border border-red-500/40 text-red-200 text-sm rounded-xl px-4 py-3">{{ session('error') }}</div>
    @endif

    <div class="grid sm:grid-cols-2 gap-4 mt-8 text-left">
        <a href="/login/siswa" class="bg-white text-slate-900 rounded-3xl p-6 hover:scale-[1.01] transition">
            <div class="text-4xl">🎒</div>
            <p class="font-bold text-xl mt-2">Saya Murid</p>
            <p class="text-sm text-slate-500 mt-1">Masuk dengan NIS + password. Lihat tugas, nilai, dan kelas virtual.</p>
            <span class="inline-block mt-4 px-5 py-3 bg-blue-800 text-white text-sm font-bold rounded-xl">Login sebagai Murid →</span>
        </a>
        <a href="/login/guru" class="bg-emerald-500 text-slate-900 rounded-3xl p-6 hover:scale-[1.01] transition">
            <div class="text-4xl">👩‍🏫</div>
            <p class="font-bold text-xl mt-2">Saya Guru</p>
            <p class="text-sm text-emerald-950 mt-1">Masuk dengan NIP + PIN sekolah. Kelola materi, nilai & CBT.</p>
            <span class="inline-block mt-4 px-5 py-3 bg-slate-900 text-white text-sm font-bold rounded-xl">Login sebagai Guru →</span>
        </a>
    </div>
    <p class="text-xs text-slate-500 mt-6">Belum punya akun? Siswa terima akun saat MPLS • Guru hubungi Admin IT.</p>
</div>
</body>
</html>
