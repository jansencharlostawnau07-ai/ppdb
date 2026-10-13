@extends('layouts.ppdb')
@section('title', 'Formulir SPMB 2027/2028')
@section('content')
<div class="bg-white p-6 rounded-2xl shadow">
<h1 class="text-lg font-extrabold text-navy-900 mb-1">Formulir SPMB 2027/2028 (4 Step)</h1>
<p class="text-xs text-slate-500 mb-4">Step 1 Data Siswa • Step 2 Data Ortu • Step 3 Upload • Step 4 Bukti Transfer (nomor di Step 4)</p>
<form method="POST" action="{{ route('ppdb.store') }}" enctype="multipart/form-data" class="grid md:grid-cols-2 gap-4 text-sm">
@csrf
<div class="md:col-span-2 font-bold text-navy-900 border-b pb-1">Step 1 — Data Calon Siswa</div>
<div><label class="font-semibold">Nama Lengkap *</label><input name="nama_lengkap" value="{{ old('nama_lengkap') }}" required class="w-full border rounded px-3 py-2"></div>
<div class="grid grid-cols-2 gap-2">
<div><label class="font-semibold">NISN</label><input name="nisn" value="{{ old('nisn') }}" class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">NIK</label><input name="nik" value="{{ old('nik') }}" class="w-full border rounded px-3 py-2"></div>
</div>
<div><label class="font-semibold">Jenis Kelamin *</label><select name="jenis_kelamin" required class="w-full border rounded px-3 py-2"><option value="L" @selected(old('jenis_kelamin')=='L')>Laki-laki</option><option value="P" @selected(old('jenis_kelamin')=='P')>Perempuan</option></select></div>
<div class="grid grid-cols-2 gap-2">
<div><label class="font-semibold">Tempat Lahir</label><input name="tempat_lahir" value="{{ old('tempat_lahir') }}" class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">Tanggal Lahir *</label><input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required class="w-full border rounded px-3 py-2"></div>
</div>
<div><label class="font-semibold">Agama</label><input name="agama" value="{{ old('agama') }}" placeholder="Katolik / Kristen / ..." class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">No. HP Siswa *</label><input name="no_hp" value="{{ old('no_hp') }}" required class="w-full border rounded px-3 py-2"></div>
<div class="md:col-span-2"><label class="font-semibold">Alamat *</label><textarea name="alamat" required class="w-full border rounded px-3 py-2">{{ old('alamat') }}</textarea></div>
<div><label class="font-semibold">Asal SMP *</label><input name="asal_sekolah" value="{{ old('asal_sekolah') }}" required class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">Kategori Asal SMP *</label><select name="asal_smp_kategori" class="w-full border rounded px-3 py-2"><option value="ypsb">SMP Naungan YPSB</option><option value="suster">SMP Suster Pontianak</option><option value="umum" selected>SMP Umum</option></select></div>
<div class="grid grid-cols-3 gap-2 md:col-span-2">
<div><label class="font-semibold">Gelombang *</label><select name="gelombang" class="w-full border rounded px-3 py-2"><option value="1">1 (1 Okt–18 Des 2026)</option><option value="2">2 (4 Jan–31 Mar 2027)</option></select></div>
<div><label class="font-semibold">Jalur</label><select name="jalur" class="w-full border rounded px-3 py-2"><option value="reguler">Reguler</option><option value="prestasi">Prestasi/Beasiswa</option><option value="afirmasi">Afirmasi</option></select></div>
<div><label class="font-semibold">Skema *</label><select name="skema_bayar" class="w-full border rounded px-3 py-2"><option value="lunas">Lunas 1x</option><option value="angsuran">Angsuran 2x</option></select></div>
</div>
<div class="md:col-span-2 font-bold text-navy-900 border-b pb-1 mt-2">Step 2 — Data Orang Tua / Wali</div>
<div><label class="font-semibold">Nama Ayah</label><input name="nama_ayah" value="{{ old('nama_ayah') }}" class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">Pekerjaan Ayah</label><input name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah') }}" class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">Nama Ibu</label><input name="nama_ibu" value="{{ old('nama_ibu') }}" class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">Pekerjaan Ibu</label><input name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu') }}" class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">No. HP Ortu</label><input name="no_hp_ortu" value="{{ old('no_hp_ortu') }}" class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">Email</label><input type="email" name="email" value="{{ old('email') }}" class="w-full border rounded px-3 py-2"></div>
<div class="md:col-span-2 font-bold text-navy-900 border-b pb-1 mt-2">Step 3 — Upload Berkas (PDF/JPG/PNG, maks 2MB)</div>
<div><label class="font-semibold">Akte Lahir (PDF)</label><input type="file" name="file_akta" class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">Kartu Keluarga (PDF)</label><input type="file" name="file_kk" class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">KTP Ortu/Wali (PDF)</label><input type="file" name="file_ktp_ortu" class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">Surat Baptis / Pernyataan (PDF)</label><input type="file" name="file_baptis" class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">Rapor Kls 8 Ganjil (PDF)</label><input type="file" name="file_rapor_8_ganjil" class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">Rapor Kls 8 Genap (PDF)</label><input type="file" name="file_rapor_8_genap" class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">Pasfoto 3x4 (JPG/PNG)</label><input type="file" name="file_foto" class="w-full border rounded px-3 py-2"></div>
<div class="md:col-span-2 font-bold text-navy-900 border-b pb-1 mt-2">Step 4 — Bukti Pembayaran</div>
<p class="md:col-span-2 text-xs bg-blue-50 border border-blue-200 rounded p-2">Transfer ke <b>BNI 6617710032 a.n. YPSB SMA STO PAULUS</b>. Pastikan nama penerima benar, lalu unggah bukti + isi nominal. Konfirmasi ke WA resmi panitia.</p>
<div><label class="font-semibold">Nominal Transfer (Rp)</label><input type="number" name="nominal_transfer" value="{{ old('nominal_transfer') }}" class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">Bukti Transfer (JPG/PDF)</label><input type="file" name="file_bukti_transfer" class="w-full border rounded px-3 py-2"></div>
<p class="md:col-span-2 text-xs bg-amber-50 border rounded p-2">Non-Katolik wajib Surat Pernyataan (diunggah di kolom Baptis).</p>
<div class="md:col-span-2 mt-2"><button class="px-6 py-2 bg-navy-900 text-white rounded-lg font-bold">Kirim Pendaftaran</button></div>
</form>
</div>
@endsection
