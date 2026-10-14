@extends('layouts.ppdb')
@section('title', 'Halaman tidak ditemukan')
@section('content')
<div class="bg-white p-10 rounded-2xl shadow text-center">
<div class="text-5xl font-extrabold text-navy-900">404</div>
<p class="text-sm mt-2">Halaman tidak ditemukan. Mungkin link salah atau sudah dipindah.</p>
<div class="mt-4 flex justify-center gap-2">
<a href="{{ route('ppdb.home') }}" class="px-5 py-2 bg-navy-900 text-white rounded-lg font-bold">Beranda SPMB</a>
<a href="{{ route('ppdb.daftar') }}" class="px-5 py-2 border rounded-lg">Daftar</a>
</div>
</div>
@endsection
