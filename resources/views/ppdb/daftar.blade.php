@extends('layouts.ppdb')
@section('title', 'Formulir Pendaftaran')
@section('content')
<div class="bg-white p-6 rounded shadow">
<h1 class="text-lg font-bold text-blue-900 mb-4">Formulir Pendaftaran Siswa Baru</h1>
<form method="POST" action="{{ route('ppdb.store') }}" enctype="multipart/form-data" class="grid md:grid-cols-2 gap-4 text-sm">
@csrf
<div class="md:col-span-2 font-bold text-blue-900 border-b pb-1">Data Siswa</div>
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
<div><label class="font-semibold">Agama</label><input name="agama" value="{{ old('agama') }}" class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">No. HP Siswa *</label><input name="no_hp" value="{{ old('no_hp') }}" required class="w-full border rounded px-3 py-2"></div>
<div class="md:col-span-2"><label class="font-semibold">Alamat *</label><textarea name="alamat" required class="w-full border rounded px-3 py-2">{{ old('alamat') }}</textarea></div>
<div><label class="font-semibold">Email</label><input type="email" name="email" value="{{ old('email') }}" class="w-full border rounded px-3 py-2"></div>
<div class="grid grid-cols-2 gap-2">
<div><label class="font-semibold">Asal Sekolah *</label><input name="asal_sekolah" value="{{ old('asal_sekolah') }}" required class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">Tahun Lulus</label><input name="tahun_lulus" value="{{ old('tahun_lulus') }}" class="w-full border rounded px-3 py-2"></div>
</div>
<div><label class="font-semibold">Rata-rata Rapor</label><input type="number" step="0.01" name="rata_rata_rapor" value="{{ old('rata_rata_rapor') }}" class="w-full border rounded px-3 py-2"></div>
<div class="grid grid-cols-2 gap-2">
<div><label class="font-semibold">Jalur *</label><select name="jalur" class="w-full border rounded px-3 py-2"><option value="reguler">Reguler</option><option value="prestasi">Prestasi</option><option value="afirmasi">Afirmasi</option></select></div>
<div><label class="font-semibold">Gelombang *</label><select name="gelombang" class="w-full border rounded px-3 py-2"><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></div>
</div>
<div class="md:col-span-2 font-bold text-blue-900 border-b pb-1 mt-2">Data Orang Tua</div>
<div><label class="font-semibold">Nama Ayah</label><input name="nama_ayah" value="{{ old('nama_ayah') }}" class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">Pekerjaan Ayah</label><input name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah') }}" class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">Nama Ibu</label><input name="nama_ibu" value="{{ old('nama_ibu') }}" class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">Pekerjaan Ibu</label><input name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu') }}" class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">No. HP Ortu</label><input name="no_hp_ortu" value="{{ old('no_hp_ortu') }}" class="w-full border rounded px-3 py-2"></div>
<div class="md:col-span-2 font-bold text-blue-900 border-b pb-1 mt-2">Upload Berkas (jpg/png/pdf, maks 2MB)</div>
<div><label class="font-semibold">KK</label><input type="file" name="file_kk" class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">Akta Lahir</label><input type="file" name="file_akta" class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">Rapor</label><input type="file" name="file_rapor" class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">Pas Foto</label><input type="file" name="file_foto" class="w-full border rounded px-3 py-2"></div>
<div class="md:col-span-2 mt-2"><button class="px-6 py-2 bg-blue-900 text-white rounded font-bold">Kirim Pendaftaran</button></div>
</form>
</div>
@endsection
