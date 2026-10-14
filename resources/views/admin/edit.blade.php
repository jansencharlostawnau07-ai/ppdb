@extends('layouts.ppdb')
@section('title', 'Ubah Data Pendaftar')
@section('content')
<a href="{{ route('admin.show', $pendaftar) }}" class="text-sm text-blue-700 underline">&larr; Kembali ke Detail</a>
<div class="bg-white p-6 rounded shadow mt-2 text-sm">
<h1 class="font-bold text-blue-900 text-lg">Ubah Data — {{ $pendaftar->no_pendaftaran }}</h1>
<form method="POST" action="{{ route('admin.update', $pendaftar) }}" class="grid md:grid-cols-2 gap-4 mt-3">
@csrf @method('PUT')
<div><label class="font-semibold">Nama Lengkap *</label><input name="nama_lengkap" value="{{ old('nama_lengkap', $pendaftar->nama_lengkap) }}" required class="w-full border rounded px-3 py-2"></div>
<div class="grid grid-cols-2 gap-2">
<div><label class="font-semibold">NISN (10 digit)</label><input name="nisn" value="{{ old('nisn', $pendaftar->nisn) }}" inputmode="numeric" maxlength="10" class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">NIK (16 digit)</label><input name="nik" value="{{ old('nik', $pendaftar->nik) }}" inputmode="numeric" maxlength="16" class="w-full border rounded px-3 py-2"></div>
</div>
<div><label class="font-semibold">Jenis Kelamin *</label><select name="jenis_kelamin" class="w-full border rounded px-3 py-2"><option value="L" @selected(old('jenis_kelamin', $pendaftar->jenis_kelamin)=='L')>Laki-laki</option><option value="P" @selected(old('jenis_kelamin', $pendaftar->jenis_kelamin)=='P')>Perempuan</option></select></div>
<div class="grid grid-cols-2 gap-2">
<div><label class="font-semibold">Tempat Lahir</label><input name="tempat_lahir" value="{{ old('tempat_lahir', $pendaftar->tempat_lahir) }}" class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">Tanggal Lahir *</label><input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $pendaftar->tanggal_lahir?->format('Y-m-d')) }}" required class="w-full border rounded px-3 py-2"></div>
</div>
<div><label class="font-semibold">Agama</label><input name="agama" value="{{ old('agama', $pendaftar->agama) }}" class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">No. HP *</label><input name="no_hp" value="{{ old('no_hp', $pendaftar->no_hp) }}" required class="w-full border rounded px-3 py-2"></div>
<div class="md:col-span-2"><label class="font-semibold">Alamat *</label><textarea name="alamat" required class="w-full border rounded px-3 py-2">{{ old('alamat', $pendaftar->alamat) }}</textarea></div>
<div><label class="font-semibold">Email</label><input type="email" name="email" value="{{ old('email', $pendaftar->email) }}" class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">Asal SMP *</label><input name="asal_sekolah" value="{{ old('asal_sekolah', $pendaftar->asal_sekolah) }}" required class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">Kategori SMP *</label><select name="asal_smp_kategori" class="w-full border rounded px-3 py-2">@foreach(['ypsb'=>'YPSB','suster'=>'Suster','umum'=>'Umum'] as $v=>$l)<option value="{{ $v }}" @selected(old('asal_smp_kategori', $pendaftar->asal_smp_kategori)==$v)>{{ $l }}</option>@endforeach</select></div>
<div class="grid grid-cols-3 gap-2 md:col-span-2">
<div><label class="font-semibold">Jalur</label><select name="jalur" class="w-full border rounded px-3 py-2">@foreach(['reguler','prestasi','afirmasi'] as $j)<option value="{{ $j }}" @selected(old('jalur', $pendaftar->jalur)==$j)>{{ $j }}</option>@endforeach</select></div>
<div><label class="font-semibold">Gelombang</label><select name="gelombang" class="w-full border rounded px-3 py-2"><option value="1" @selected(old('gelombang', $pendaftar->gelombang)=='1')>1</option><option value="2" @selected(old('gelombang', $pendaftar->gelombang)=='2')>2</option></select></div>
<div><label class="font-semibold">Skema</label><select name="skema_bayar" class="w-full border rounded px-3 py-2"><option value="lunas" @selected(old('skema_bayar', $pendaftar->skema_bayar)=='lunas')>Lunas</option><option value="angsuran" @selected(old('skema_bayar', $pendaftar->skema_bayar)=='angsuran')>Angsuran</option></select></div>
</div>
<div><label class="font-semibold">Nama Ayah</label><input name="nama_ayah" value="{{ old('nama_ayah', $pendaftar->nama_ayah) }}" class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">Pekerjaan Ayah</label><input name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah', $pendaftar->pekerjaan_ayah) }}" class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">Nama Ibu</label><input name="nama_ibu" value="{{ old('nama_ibu', $pendaftar->nama_ibu) }}" class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">Pekerjaan Ibu</label><input name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu', $pendaftar->pekerjaan_ibu) }}" class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">No. HP Ortu</label><input name="no_hp_ortu" value="{{ old('no_hp_ortu', $pendaftar->no_hp_ortu) }}" class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">Nominal Bayar Terverifikasi (Rp)</label><input type="number" name="nominal_bayar" value="{{ old('nominal_bayar', $pendaftar->nominal_bayar) }}" class="w-full border rounded px-3 py-2"></div>
<div class="md:col-span-2"><button class="px-6 py-2 bg-navy-900 text-white rounded-lg font-bold">Simpan Perubahan</button></div>
</form>
</div>
@endsection
