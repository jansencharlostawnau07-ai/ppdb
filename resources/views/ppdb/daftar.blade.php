@extends('layouts.ppdb')
@section('title', 'Formulir SPMB 2027/2028')
@section('content')
<div class="bg-white p-6 rounded-2xl shadow max-w-3xl mx-auto">
<h1 class="text-lg font-extrabold text-navy-900 mb-1">Formulir SPMB 2027/2028</h1>

@if(session('success'))
<div class="mb-4 p-3 rounded bg-green-100 border border-green-300 text-green-800 text-sm">{{ session('success') }}</div>
@endif
@if($errors->any())
<div class="mb-4 p-3 rounded bg-red-100 border border-red-300 text-red-800 text-sm">
<ul class="list-disc ml-5">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
</div>
@endif

<div class="flex items-center justify-between mb-2">
<span class="text-xs font-bold text-navy-900 uppercase">Langkah {{ $step }} dari 4</span>
</div>
<div class="w-full bg-slate-200 rounded-full h-2 mb-6">
<div class="bg-navy-900 h-2 rounded-full" style="width: {{ (($step - 1) / 3) * 100 }}%"></div>
</div>

<form method="POST" action="{{ route('ppdb.daftar.step', ['step' => $step]) }}" enctype="multipart/form-data" class="space-y-4 text-sm">
@csrf

@if($step === 1)
<div class="md:col-span-2 font-bold text-navy-900 border-b pb-1">Step 1 — Data Calon Siswa</div>
<div><label class="font-semibold">Nama Lengkap *</label><input name="nama_lengkap" value="{{ old('nama_lengkap', $saved['step1']['nama_lengkap'] ?? '') }}" required class="w-full border rounded px-3 py-2"></div>
<div class="grid grid-cols-2 gap-2">
<div><label class="font-semibold">NISN (10 digit)</label><input name="nisn" id="nisn" value="{{ old('nisn', $saved['step1']['nisn'] ?? '') }}" inputmode="numeric" maxlength="10" placeholder="10 digit Dapodik" class="w-full border rounded px-3 py-2"><div id="nisn-count" class="text-[11px] text-slate-500 mt-0.5">0/10</div></div>
<div><label class="font-semibold">NIK (16 digit)</label><input name="nik" id="nik" value="{{ old('nik', $saved['step1']['nik'] ?? '') }}" inputmode="numeric" maxlength="16" placeholder="16 digit KK/KTP" class="w-full border rounded px-3 py-2"><div id="nik-count" class="text-[11px] text-slate-500 mt-0.5">0/16 • digit 7–12 = DDMMYY lahir</div></div>
</div>
<div><label class="font-semibold">Jenis Kelamin *</label><select name="jenis_kelamin" required class="w-full border rounded px-3 py-2"><option value="L" @selected(old('jenis_kelamin', $saved['step1']['jenis_kelamin'] ?? '') == 'L')>Laki-laki</option><option value="P" @selected(old('jenis_kelamin', $saved['step1']['jenis_kelamin'] ?? '') == 'P')>Perempuan</option></select></div>
<div class="grid grid-cols-2 gap-2">
<div><label class="font-semibold">Tempat Lahir</label><input name="tempat_lahir" value="{{ old('tempat_lahir', $saved['step1']['tempat_lahir'] ?? '') }}" class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">Tanggal Lahir *</label><input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $saved['step1']['tanggal_lahir'] ?? '') }}" required class="w-full border rounded px-3 py-2"></div>
</div>
<div><label class="font-semibold">Agama</label><input name="agama" value="{{ old('agama', $saved['step1']['agama'] ?? '') }}" placeholder="Katolik / Kristen / ..." class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">No. HP Siswa *</label><input name="no_hp" value="{{ old('no_hp', $saved['step1']['no_hp'] ?? '') }}" required class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">Alamat *</label><textarea name="alamat" required class="w-full border rounded px-3 py-2">{{ old('alamat', $saved['step1']['alamat'] ?? '') }}</textarea></div>
<div><label class="font-semibold">Asal SMP *</label><input name="asal_sekolah" value="{{ old('asal_sekolah', $saved['step1']['asal_sekolah'] ?? '') }}" required class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">Kategori Asal SMP *</label><select name="asal_smp_kategori" class="w-full border rounded px-3 py-2"><option value="ypsb" @selected(old('asal_smp_kategori', $saved['step1']['asal_smp_kategori'] ?? '') == 'ypsb')>SMP Naungan YPSB</option><option value="suster" @selected(old('asal_smp_kategori', $saved['step1']['asal_smp_kategori'] ?? '') == 'suster')>SMP Suster Pontianak</option><option value="umum" @selected(old('asal_smp_kategori', $saved['step1']['asal_smp_kategori'] ?? '') == 'umum')>SMP Umum</option></select></div>
<div class="grid grid-cols-3 gap-2">
<div><label class="font-semibold">Gelombang *</label><select name="gelombang" class="w-full border rounded px-3 py-2"><option value="1" @selected(old('gelombang', $saved['step1']['gelombang'] ?? '') == '1')>1 (1 Okt–18 Des 2026)</option><option value="2" @selected(old('gelombang', $saved['step1']['gelombang'] ?? '') == '2')>2 (4 Jan–31 Mar 2027)</option></select></div>
<div><label class="font-semibold">Jalur</label><select name="jalur" class="w-full border rounded px-3 py-2"><option value="reguler" @selected(old('jalur', $saved['step1']['jalur'] ?? '') == 'reguler')>Reguler</option><option value="prestasi" @selected(old('jalur', $saved['step1']['jalur'] ?? '') == 'prestasi')>Prestasi/Beasiswa</option><option value="afirmasi" @selected(old('jalur', $saved['step1']['jalur'] ?? '') == 'afirmasi')>Afirmasi</option></select></div>
<div><label class="font-semibold">Skema *</label><select name="skema_bayar" class="w-full border rounded px-3 py-2"><option value="lunas" @selected(old('skema_bayar', $saved['step1']['skema_bayar'] ?? '') == 'lunas')>Lunas 1x</option><option value="angsuran" @selected(old('skema_bayar', $saved['step1']['skema_bayar'] ?? '') == 'angsuran')>Angsuran 2x</option></select></div>
</div>
</div>

@elseif($step === 2)
<div class="md:col-span-2 font-bold text-navy-900 border-b pb-1">Step 2 — Data Orang Tua / Wali</div>
<div><label class="font-semibold">Nama Ayah</label><input name="nama_ayah" value="{{ old('nama_ayah', $saved['step2']['nama_ayah'] ?? '') }}" class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">Pekerjaan Ayah</label><input name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah', $saved['step2']['pekerjaan_ayah'] ?? '') }}" class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">Nama Ibu</label><input name="nama_ibu" value="{{ old('nama_ibu', $saved['step2']['nama_ibu'] ?? '') }}" class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">Pekerjaan Ibu</label><input name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu', $saved['step2']['pekerjaan_ibu'] ?? '') }}" class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">No. HP Ortu</label><input name="no_hp_ortu" value="{{ old('no_hp_ortu', $saved['step2']['no_hp_ortu'] ?? '') }}" class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">Email</label><input type="email" name="email" value="{{ old('email', $saved['step2']['email'] ?? $saved['step1']['email'] ?? auth()->user()->email ?? '') }}" class="w-full border rounded px-3 py-2"></div>
</div>

@elseif($step === 3)
<div class="md:col-span-2 font-bold text-navy-900 border-b pb-1">Step 3 — Upload Berkas (PDF/JPG/PNG, maks 2MB)</div>
<div><label class="font-semibold">Akte Lahir (PDF)</label><input type="file" name="file_akta" class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">Kartu Keluarga (PDF)</label><input type="file" name="file_kk" class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">KTP Ortu/Wali (PDF)</label><input type="file" name="file_ktp_ortu" class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">Surat Baptis / Pernyataan (PDF)</label><input type="file" name="file_baptis" class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">Rapor Kls 8 Ganjil (PDF)</label><input type="file" name="file_rapor_8_ganjil" class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">Rapor Kls 8 Genap (PDF)</label><input type="file" name="file_rapor_8_genap" class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">Pasfoto 3x4 (JPG/PNG)</label><input type="file" name="file_foto" class="w-full border rounded px-3 py-2"></div>
</div>

@elseif($step === 4)
<div class="md:col-span-2 font-bold text-navy-900 border-b pb-1">Step 4 — Bukti Pembayaran</div>
<p class="text-xs bg-blue-50 border border-blue-200 rounded p-2">Transfer ke <b>BNI 6617710032 a.n. YPSB SMA STO PAULUS</b>. Pastikan nama penerima benar, lalu unggah bukti + isi nominal. Konfirmasi ke WA resmi panitia.</p>
<div><label class="font-semibold">Bukti Transfer (JPG/PDF)</label><input type="file" name="file_bukti_transfer" class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">Nominal Transfer (Rp)</label><input type="number" name="nominal_transfer" value="{{ old('nominal_transfer', $saved['step4']['nominal_bayar'] ?? $saved['step4']['nominal_transfer'] ?? '') }}" class="w-full border rounded px-3 py-2"></div>
<p class="text-xs bg-amber-50 border rounded p-2">Non-Katolik wajib Surat Pernyataan (diunggah di kolom Baptis).</p>
</div>
@endif

<div class="mt-6 flex justify-between items-center">
@if($step > 1)
<a href="{{ route('ppdb.daftar', ['step' => $step - 1]) }}" class="px-5 py-2 border rounded text-sm">Sebelumnya</a>
@endif
@if($step < 4)
<button type="submit" class="px-5 py-2 bg-navy-900 text-white rounded-lg font-bold">Selanjutnya</button>
@else
<button type="submit" class="px-5 py-2 bg-navy-900 text-white rounded-lg font-bold">Selesai &amp; Kirim</button>
@endif
</div>
</form>
<script>
(function(){
function bind(id, out, max){
var el=document.getElementById(id), o=document.getElementById(out);
if(!el) return;
function upd(){
el.value=el.value.replace(/\D/g,'').slice(0,max);
if(o) o.textContent=el.value.length+'/'+max+(id==='nik'?' • digit 7–12 = DDMMYY lahir':'');
}
el.addEventListener('input', upd); upd();
}
bind('nisn','nisn-count',10); bind('nik','nik-count',16);
})();
</script>
</div>
@endsection