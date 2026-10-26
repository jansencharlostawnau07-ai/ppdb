@extends('layouts.ppdb')
@section('title', 'Konfirmasi Pendaftaran')
@section('content')
<div class="bg-white p-6 rounded-2xl shadow max-w-2xl mx-auto">
<h1 class="text-lg font-extrabold text-navy-900 mb-1">Konfirmasi Pendaftaran</h1>
<p class="text-sm text-slate-500 mb-4">Periksa data Anda sebelum dikirimkan ke panitia.</p>

<div class="bg-slate-50 rounded-xl p-4 mb-4">
<h2 class="font-bold text-navy-900 mb-2">Data Calon Siswa</h2>
<div class="grid grid-cols-2 gap-2 text-sm">
<div><span class="font-bold">Nama:</span> {{ $saved['step1']['nama_lengkap'] ?? '-' }}</div>
<div><span class="font-bold">NISN:</span> {{ $saved['step1']['nisn'] ?? '-' }}</div>
<div><span class="font-bold">NIK:</span> {{ $saved['step1']['nik'] ?? '-' }}</div>
<div><span class="font-bold">Jenis Kelamin:</span> {{ $saved['step1']['jenis_kelamin'] ?? '-' }}</div>
<div><span class="font-bold">Tempat/Tgl Lahir:</span> {{ $saved['step1']['tempat_lahir'] ?? '-' }}, {{ $saved['step1']['tanggal_lahir'] ?? '-' }}</div>
<div><span class="font-bold">Agama:</span> {{ $saved['step1']['agama'] ?? '-' }}</div>
<div><span class="font-bold">No. HP:</span> {{ $saved['step1']['no_hp'] ?? '-' }}</div>
<div><span class="font-bold">Alamat:</span> {{ $saved['step1']['alamat'] ?? '-' }}</div>
<div><span class="font-bold">Asal SMP:</span> {{ $saved['step1']['asal_sekolah'] ?? '-' }}</div>
<div><span class="font-bold">Kategori:</span> {{ $saved['step1']['asal_smp_kategori'] ?? '-' }}</div>
<div><span class="font-bold">Gelombang:</span> {{ $saved['step1']['gelombang'] ?? '-' }}</div>
<div><span class="font-bold">Jalur:</span> {{ $saved['step1']['jalur'] ?? '-' }}</div>
<div><span class="font-bold">Skema:</span> {{ $saved['step1']['skema_bayar'] ?? '-' }}</div>
</div>
</div>

<div class="bg-slate-50 rounded-xl p-4 mb-4">
<h2 class="font-bold text-navy-900 mb-2">Data Orang Tua</h2>
<div class="grid grid-cols-2 gap-2 text-sm">
<div><span class="font-bold">Ayah:</span> {{ $saved['step2']['nama_ayah'] ?? '-' }}</div>
<div><span class="font-bold">Pekerjaan Ayah:</span> {{ $saved['step2']['pekerjaan_ayah'] ?? '-' }}</div>
<div><span class="font-bold">Ibu:</span> {{ $saved['step2']['nama_ibu'] ?? '-' }}</div>
<div><span class="font-bold">Pekerjaan Ibu:</span> {{ $saved['step2']['pekerjaan_ibu'] ?? '-' }}</div>
<div><span class="font-bold">No. HP Ortu:</span> {{ $saved['step2']['no_hp_ortu'] ?? '-' }}</div>
<div><span class="font-bold">Email:</span> {{ $saved['step2']['email'] ?? '-' }}</div>
</div>
</div>

<div class="bg-slate-50 rounded-xl p-4 mb-4">
<h2 class="font-bold text-navy-900 mb-2">Berkas yang diunggah</h2>
<div class="text-sm">
@php
$files = array_merge($saved['step3'] ?? [], $saved['step4'] ?? []);
@endphp
@foreach($files as $field => $path)
<div class="flex items-center gap-2 text-xs mb-1"><span class="font-bold">{{ $field }}:</span> {{ basename($path) }}</div>
@endforeach
</div>
</div>

<form method="POST" action="{{ route('ppdb.daftar.submit') }}" class="space-y-3">
@csrf
<div class="flex justify-between">
<a href="{{ route('ppdb.daftar', ['step' => 1]) }}" class="px-5 py-2 border rounded text-sm">Kembali ke Langkah 1</a>
<button type="submit" class="px-5 py-2 bg-navy-900 text-white rounded-lg font-bold">Kirim Pendaftaran Sekarang</button>
</div>
<p class="text-xs text-slate-500 mt-2">Data akan disimpan ke database sekolah dan Anda akan menerima nomor pendaftaran.</p>
</form>
</div>
@endsection