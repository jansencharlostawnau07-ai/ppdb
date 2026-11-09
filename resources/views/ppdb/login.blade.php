@extends('layouts.ppdb')
@section('title', 'Masuk Pendaftar — SPMB 2027/2028')
@section('content')
<div class="bg-white p-6 rounded-2xl shadow max-w-md mx-auto">
    <h1 class="text-lg font-extrabold text-navy-900 mb-1">Masuk untuk Mendaftar</h1>
    <p class="text-sm text-slate-600 mb-4">Gunakan akun Google untuk memulai pendaftaran SPMB. Ini membantu mencegah pendaftaran bot/iseng dan memungkinkan Anda <b>menyimpan &amp; melanjutkan</b> isian yang belum selesai. <span class="text-slate-500">(Jika Google belum dikonfigurasi, sistem akan menampilkan simulasi login untuk keperluan tampilan/demo.)</span></p>

    @if($errors->any())
    <div class="mb-4 p-3 rounded bg-red-100 border border-red-300 text-red-800 text-sm">
        <ul class="list-disc ml-5">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
    @endif

    <a href="{{ route('ppdb.auth.google') }}" class="w-full py-3 bg-white border border-slate-300 rounded-xl flex items-center justify-center gap-2 font-bold text-slate-800 hover:bg-slate-50 shadow-sm">
        <svg class="w-5 h-5" viewBox="0 0 48 48" aria-hidden="true"><path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"/><path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"/><path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"/><path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"/></svg>
        Masuk dengan Google
    </a>

    <p class="text-[11px] text-slate-500 mt-4">Satu akun Google digunakan untuk satu pendaftaran. Data Anda akan digunakan untuk proses SPMB SMA Santo Paulus.</p>
</div>
@endsection
