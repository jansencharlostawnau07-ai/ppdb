@extends('layouts.ppdb')
@section('title', 'FAQ SPMB 2027/2028')
@section('content')
<div class="bg-white p-6 rounded-2xl shadow text-sm">
<h1 class="font-extrabold text-navy-900 text-xl">Pertanyaan Umum (FAQ)</h1>
<div class="mt-3 space-y-3">
<div class="border rounded-xl p-4"><div class="font-bold">Non-Katolik wajib Surat Baptis?</div><p class="mt-1">Tidak. Non-Katolik mengganti dengan Surat Pernyataan (diunggah di kolom Baptis). Materai 2 lembar hanya untuk daftar offline.</p></div>
<div class="border rounded-xl p-4"><div class="font-bold">Bisa angsuran?</div><p class="mt-1">Bisa, 2x. Angsuran I saat daftar, pelunasan/angsuran II maks 31 Juli 2027. Lewat itu dianggap mengundurkan diri & hangus.</p></div>
<div class="border rounded-xl p-4"><div class="font-bold">Mundur / tidak lulus SMP, uang kembali?</div><p class="mt-1">Mundur sepihak hangus 100%. Tidak lulus SMP kembali 100% dengan SK Tidak Lulus + Kwitansi.</p></div>
<div class="border rounded-xl p-4"><div class="font-bold">Rapor yang dipakai?</div><p class="mt-1">Kelas 8 Ganjil + Genap (tahun penuh terakhir yang sudah final). Kelas 9 belum lengkap saat pendaftaran.</p></div>
<div class="border rounded-xl p-4"><div class="font-bold">Beasiswa bagaimana?</div><p class="mt-1">Pilih jalur Prestasi/Beasiswa, lampirkan sertifikat/surat keterangan, lalu WA Lenny 0812-5036-8308.</p></div>
<div class="border rounded-xl p-4"><div class="font-bold">Kapan gelombang dibuka?</div><p class="mt-1">Gel.1: 1 Okt–18 Des 2026. Gel.2: 4 Jan–31 Mar 2027 atau hingga kuota terpenuhi.</p></div>
</div>
<div class="mt-4 flex gap-2"><a href="{{ route('ppdb.daftar') }}" class="px-5 py-2 bg-navy-900 text-white rounded-lg font-bold">Daftar</a><a href="https://wa.me/6281257928672?text=Halo%20panitia%20SPMB%20Santo%20Paulus" target="_blank" class="px-5 py-2 bg-green-600 text-white rounded-lg font-bold">Tanya via WA</a></div>
</div>
@endsection
