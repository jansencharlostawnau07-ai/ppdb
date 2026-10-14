@extends('layouts.ppdb')
@section('title', 'Beasiswa SPMB 2027/2028')
@section('content')
<div class="bg-white p-6 rounded-2xl shadow text-sm">
<h1 class="font-extrabold text-navy-900 text-xl">Program Beasiswa</h1>
<div class="grid md:grid-cols-2 gap-4 mt-3">
<div class="border rounded-xl p-4"><div class="font-bold">Akademik Khusus SMP YPSB</div><div class="text-xs text-slate-500">Bruder Pontianak, Bruder Singkawang, Karya Budi Putussibau — Juara Umum/Pararel Kls VIII, bawa surat keterangan.</div><ul class="mt-2 list-disc ml-5"><li>Juara Umum 1: potongan 100% DPP</li><li>Juara Umum 2: potongan 80% DPP</li><li>Juara Umum 3: potongan 50% DPP</li></ul></div>
<div class="border rounded-xl p-4"><div class="font-bold">Prestasi Umum / Puspresnas</div><div class="text-xs text-slate-500">Min. tingkat Provinsi, lampirkan sertifikat.</div><ul class="mt-2 list-disc ml-5"><li>Nasional / Juara 1 Provinsi: 100% DPP</li><li>Juara 2 Provinsi: 80% DPP</li><li>Juara 3 Provinsi: 50% DPP</li></ul></div>
<div class="border rounded-xl p-4"><div class="font-bold">Anak Guru & Karyawan YPSB</div><ul class="mt-2 list-disc ml-5"><li>Potongan 50% DPP & 50% SPP</li><li>Lampirkan fotokopi/scan KK</li></ul></div>
<div class="border rounded-xl p-4"><div class="font-bold">Juara Pararel SMP Kota Pontianak</div><p class="mt-2">Hubungi panitia: Lenny, M.A. 0812-5036-8308 untuk informasi lanjut.</p></div>
</div>
<div class="mt-4 flex flex-wrap gap-2">
<a href="{{ route('ppdb.daftar') }}" class="px-5 py-2 bg-navy-900 text-white rounded-lg font-bold">Daftar + Lampirkan Bukti Beasiswa</a>
<a href="https://wa.me/6281250368308?text=Halo%20panitia%20beasiswa%20SPMB%20Santo%20Paulus%202027/2028" target="_blank" class="px-5 py-2 bg-green-600 text-white rounded-lg font-bold">WA Lenny (Beasiswa)</a>
</div>
</div>
@endsection
