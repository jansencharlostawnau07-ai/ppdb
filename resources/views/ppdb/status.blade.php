@extends('layouts.ppdb')
@section('title', 'Status Pendaftaran')
@section('content')
<div class="bg-white p-6 rounded shadow">
<h1 class="font-bold text-blue-900">Status: {{ $pendaftaran->no_pendaftaran }}</h1>
<div class="mt-3 text-sm grid md:grid-cols-2 gap-2">
<div>Nama: <b>{{ $pendaftaran->nama_lengkap }}</b></div>
<div>Asal Sekolah: <b>{{ $pendaftaran->asal_sekolah }}</b></div>
<div>Jalur/Gelombang: <b>{{ $pendaftaran->jalur }} / {{ $pendaftaran->gelombang }}</b></div>
<div>Tanggal Daftar: <b>{{ $pendaftaran->created_at->format('d M Y H:i') }}</b></div>
</div>
<div class="mt-4 p-4 rounded text-sm
@if($pendaftaran->status=='diterima') bg-green-100 border border-green-300
@elseif($pendaftaran->status=='ditolak') bg-red-100 border border-red-300
@elseif($pendaftaran->status=='diverifikasi') bg-blue-100 border border-blue-300
@else bg-amber-100 border border-amber-300 @endif">
Status: <b class="uppercase">{{ $pendaftaran->status }}</b>
@if($pendaftaran->catatan_admin)<div class="mt-1">Catatan panitia: {{ $pendaftaran->catatan_admin }}</div>@endif
@if($pendaftaran->status=='pending')<div class="mt-1">Berkas sedang antre verifikasi panitia.</div>@endif
@if($pendaftaran->status=='diterima')<div class="mt-1">Selamat! Silakan daftar ulang ke sekolah membawa berkas asli.</div><div class="mt-2"><a href="{{ route('ppdb.kwitansi', $pendaftaran->no_pendaftaran) }}" class="underline font-bold">Cetak Kwitansi</a></div>@endif
</div>
</div>
@endsection
