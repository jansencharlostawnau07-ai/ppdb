@extends('layouts.ppdb')
@section('title', 'Detail Pendaftar')
@section('content')
<a href="{{ route('admin.dashboard') }}" class="text-sm text-blue-700 underline">&larr; Kembali</a>
<div class="bg-white p-6 rounded shadow mt-2 text-sm">
<h1 class="font-bold text-blue-900 text-lg">{{ $pendaftar->nama_lengkap }} <span class="text-xs font-normal">({{ $pendaftar->no_pendaftaran }})</span></h1>
<div class="grid md:grid-cols-2 gap-2 mt-3">
<div>NISN: {{ $pendaftar->nisn ?? '-' }}</div><div>NIK: {{ $pendaftar->nik ?? '-' }}</div>
<div>JK: {{ $pendaftar->jenis_kelamin }}</div><div>Lahir: {{ $pendaftar->tempat_lahir }} {{ $pendaftar->tanggal_lahir?->format('d-m-Y') }}</div>
<div>Agama: {{ $pendaftar->agama ?? '-' }}</div><div>HP: {{ $pendaftar->no_hp }}</div>
<div class="md:col-span-2">Alamat: {{ $pendaftar->alamat }}</div>
<div>Asal Sekolah: {{ $pendaftar->asal_sekolah }} [{{ $pendaftar->asal_smp_kategori }}]</div><div>Skema: {{ $pendaftar->skema_bayar }} • Transfer: Rp{{ number_format($pendaftar->nominal_transfer ?? 0,0,',','.') }}</div>
<div>Ayah: {{ $pendaftar->nama_ayah }} ({{ $pendaftar->pekerjaan_ayah }})</div><div>Ibu: {{ $pendaftar->nama_ibu }} ({{ $pendaftar->pekerjaan_ibu }})</div>
<div>Jalur/Gelombang: {{ $pendaftar->jalur }}/{{ $pendaftar->gelombang }}</div><div>Bank: {{ $pendaftar->nama_bank }}</div>
</div>
<div class="mt-3">
<div class="font-bold">Berkas (verifikasi + bukti bayar):</div>
<ul class="list-disc ml-5">
@foreach(['file_kk'=>'KK','file_akta'=>'Akte','file_ktp_ortu'=>'KTP Ortu','file_baptis'=>'Baptis/Pernyataan','file_rapor_8_ganjil'=>'Rapor 8 Ganjil','file_rapor_8_genap'=>'Rapor 8 Genap','file_foto'=>'Foto 3x4','file_bukti_transfer'=>'Bukti Transfer'] as $f=>$label)
<li>{{ $label }}: @if($pendaftar->$f)<a href="{{ asset('storage/'.$pendaftar->$f) }}" target="_blank" class="text-blue-700 underline">Lihat</a>@else - @endif</li>
@endforeach
</ul>
</div>
<form method="POST" action="{{ route('admin.status', $pendaftar) }}" class="mt-4 border-t pt-3 flex flex-wrap gap-2 items-end">
@csrf @method('PATCH')
<div><label class="font-semibold">Status</label><select name="status" class="border rounded px-3 py-2 block">@foreach(['pending','diverifikasi','diterima','ditolak'] as $s)<option value="{{ $s }}" @selected($pendaftar->status==$s)>{{ $s }}</option>@endforeach</select></div>
<div class="flex-1 min-w-[200px]"><label class="font-semibold">Catatan</label><input name="catatan_admin" value="{{ $pendaftar->catatan_admin }}" class="border rounded px-3 py-2 w-full"></div>
<button class="px-4 py-2 bg-blue-900 text-white rounded">Simpan</button>
</form>
<form method="POST" action="{{ route('admin.destroy', $pendaftar) }}" onsubmit="return confirm('Hapus data ini?')" class="mt-2">
@csrf @method('DELETE')
<button class="text-xs text-red-700 underline">Hapus permanen</button>
</form>
</div>
@endsection
