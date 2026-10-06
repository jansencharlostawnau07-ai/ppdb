@extends('layouts.app')
@section('title', 'Dashboard — SMA Santo Paulus')
@section('content')
<div class="max-w-5xl mx-auto px-4 py-10">
    <div class="bg-white border rounded-3xl p-6 sm:p-8">
        <p class="text-xs font-bold tracking-widest {{ $user['role'] === 'guru' ? 'text-emerald-700' : 'text-blue-800' }}">
            {{ strtoupper($user['role']) }} • LOGIN BERHASIL
        </p>
        <h1 class="text-2xl sm:text-3xl font-bold mt-1">Halo, {{ $user['name'] }} 👋</h1>
        <p class="text-sm text-slate-500 mt-2">
            @if($user['role'] === 'siswa')
                NIS: <b>{{ $user['nis'] }}</b> • Ini area privatmu: tugas, nilai, dan kelas virtual.
            @else
                NIP: <b>{{ $user['nip'] }}</b> • Ini konsol gurumu: kelas, penilaian, dan bank soal CBT.
            @endif
        </p>
        <div class="grid sm:grid-cols-3 gap-3 mt-6 text-sm">
            @if($user['role'] === 'siswa')
                <a href="/e-learning" class="border rounded-2xl p-4 hover:bg-slate-50"><p class="font-bold">📝 Tugasku</p><p class="text-slate-500 text-xs">1 deadline hari ini</p></a>
                <a href="/e-learning" class="border rounded-2xl p-4 hover:bg-slate-50"><p class="font-bold">📖 Materiku</p><p class="text-slate-500 text-xs">12 materi baru minggu ini</p></a>
                <a href="/e-learning" class="border rounded-2xl p-4 hover:bg-slate-50"><p class="font-bold">🎥 Kelas Virtual</p><p class="text-slate-500 text-xs">Besok 08.00 — B. Inggris</p></a>
            @else
                <a href="/e-learning" class="border rounded-2xl p-4 hover:bg-slate-50"><p class="font-bold">📊 Nilai Masuk</p><p class="text-slate-500 text-xs">23 tugas perlu dinilai</p></a>
                <a href="/e-learning" class="border rounded-2xl p-4 hover:bg-slate-50"><p class="font-bold">📝 Bank Soal CBT</p><p class="text-slate-500 text-xs">Kelola paket ujian</p></a>
                <a href="/e-learning" class="border rounded-2xl p-4 hover:bg-slate-50"><p class="font-bold">👥 Kehadiran</p><p class="text-slate-500 text-xs">Rekap 6 kelas</p></a>
            @endif
        </div>
        <div class="mt-6 flex flex-wrap gap-2">
            <a href="/" class="px-5 py-2.5 border text-sm font-semibold rounded-xl">← Ke Beranda Publik</a>
            <form method="POST" action="/logout" class="inline">@csrf<button class="px-5 py-2.5 bg-red-600 text-white text-sm font-bold rounded-xl">Keluar</button></form>
        </div>
    </div>
</div>
@endsection
