@extends('layouts.app')
@section('title', $title . ' — SMA Santo Paulus')
@section('content')
<div class="max-w-3xl mx-auto px-4 py-16 text-center">
    <p class="text-xs font-bold tracking-widest text-blue-800">HALAMAN SEGERA HADIR</p>
    <h1 class="text-3xl font-bold mt-2">{{ $title }}</h1>
    <p class="text-slate-500 mt-3">{{ $desc }}</p>
    <div class="mt-6 flex justify-center gap-3">
        <a href="/" class="px-5 py-2.5 bg-slate-900 text-white text-sm font-semibold rounded-xl">← Kembali ke Beranda</a>
        <a href="/ppdb" class="px-5 py-2.5 border text-sm font-semibold rounded-xl">Ke PPDB →</a>
    </div>
</div>
@endsection
