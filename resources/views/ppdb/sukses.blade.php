@extends('layouts.ppdb')
@section('title', 'Pendaftaran Berhasil')
@section('content')
<div class="bg-white p-6 rounded shadow text-center">
<div class="text-green-700 text-4xl mb-2">✓</div>
<h1 class="font-bold text-lg">Pendaftaran Berhasil!</h1>
<p class="text-sm mt-2">Nomor pendaftaran kamu:</p>
<div class="text-2xl font-bold text-blue-900 tracking-wider my-2">{{ $pendaftaran->no_pendaftaran }}</div>
<p class="text-sm">Nama: <b>{{ $pendaftaran->nama_lengkap }}</b> • Jalur {{ $pendaftaran->jalur }} • Gelombang {{ $pendaftaran->gelombang }}</p>
<p class="text-xs text-slate-500 mt-2">Screenshot / catat nomor ini. Gunakan untuk Cek Status dengan tanggal lahir.</p>
<p class="text-xs mt-2 bg-amber-50 border rounded p-2">Sudah transfer? Pastikan ke <b>BNI 6617710032 a.n. YPSB SMA STO PAULUS</b>. Belum? Nomor ini juga tampil di Step 4 form. Jangan bagikan OTP/PIN ke siapa pun.</p>
<div class="mt-4 flex flex-wrap justify-center gap-2">
<a href="{{ route('ppdb.kartu', $pendaftaran->no_pendaftaran) }}" target="_blank" class="px-4 py-2 bg-green-700 text-white rounded">Cetak Kartu</a>
<a href="https://wa.me/6281257928672?text=Halo%20panitia%20SPMB,%20saya%20{{ urlencode($pendaftaran->nama_lengkap) }}%20{{ $pendaftaran->no_pendaftaran }}" target="_blank" class="px-4 py-2 bg-green-600 text-white rounded">Konfirmasi WA</a>
<a href="{{ route('ppdb.cek.form') }}" class="px-4 py-2 bg-blue-900 text-white rounded">Cek Status</a>
<a href="{{ route('ppdb.home') }}" class="px-4 py-2 border rounded">Beranda</a>
</div>
</div>
@endsection
