@extends('layouts.ppdb')
@section('title', 'Panduan Pendaftaran SPMB 2027/2028')
@section('content')
<div class="bg-white p-6 rounded-2xl shadow text-sm">
<h1 class="font-extrabold text-navy-900 text-xl">Panduan Pendaftaran</h1>
<div class="grid md:grid-cols-2 gap-4 mt-3">
<div class="border rounded-xl p-4"><div class="font-bold text-blue-900">A. Online</div><ol class="list-decimal ml-5 mt-2 space-y-1">
<li>Buka portal ini (pengganti bit.ly/SPMBSMAPAULUSPTK) → menu Daftar.</li>
<li>Transfer ke BNI 6617710032 a.n. YPSB SMA STO PAULUS, simpan bukti.</li>
<li>Isi 4 Step: Data Siswa → Data Ortu → Upload (Akte, KK, KTP Ortu, Baptis/Pernyataan, Rapor Kls 8 Ganjil+Genap, Foto 3x4) → Bukti Transfer.</li>
<li>Terima Kartu Calon Peserta. Gunakan + bukti transfer untuk ukur seragam (vendor / WA).</li>
<li>Masuk Grup WA Ortu untuk info terkini.</li></ol></div>
<div class="border rounded-xl p-4"><div class="font-bold text-blue-900">B. Offline di Sekolah</div><ol class="list-decimal ml-5 mt-2 space-y-1">
<li>Siapkan: fotocopy Akte, KK, KTP Ortu, Baptis (masing-masing 1 lbr), Rapor Kls 8 Ganjil+Genap, Foto 3x4 2 lbr, Materai 2 lbr.</li>
<li>Ortu + anak datang ke petugas SPMB, isi formulir, serahkan berkas.</li>
<li>Bayar lunas / angsuran. Terima Kartu + Kwitansi.</li>
<li>Masuk Grup WA Ortu.</li></ol></div>
</div>
<div class="mt-4 border rounded-xl p-4"><div class="font-bold">Dokumen Wajib</div><p class="mt-1">Akta, KK, KTP Ortu/Wali, Surat Baptis (Katolik) / Surat Pernyataan (Non-Katolik), Rapor Kls 8 Ganjil & Genap, Foto 3x4, Materai 2 (offline).</p></div>
<div class="mt-3 flex gap-2"><a href="{{ route('ppdb.daftar') }}" class="px-5 py-2 bg-navy-900 text-white rounded-lg font-bold">Daftar Online</a><a href="{{ route('ppdb.biaya') }}" class="px-5 py-2 border rounded-lg">Lihat Biaya</a></div>
</div>
@endsection
