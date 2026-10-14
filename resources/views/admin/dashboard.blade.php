@extends('layouts.ppdb')
@section('title', 'Dashboard Admin')
@section('content')
<div class="flex items-center justify-between mb-4">
<h1 class="font-bold text-blue-900 text-lg">Dashboard Admin PPDB</h1>
<a href="{{ route('admin.export') }}" class="text-sm px-3 py-1 bg-green-700 text-white rounded">Export CSV</a>
</div>
<div class="grid grid-cols-2 md:grid-cols-5 gap-2 mb-4 text-center text-sm">
<div class="bg-white p-3 rounded shadow"><div class="font-bold text-lg">{{ $stats['total'] }}</div>Total</div>
<div class="bg-white p-3 rounded shadow"><div class="font-bold text-lg text-amber-600">{{ $stats['pending'] }}</div>Pending</div>
<div class="bg-white p-3 rounded shadow"><div class="font-bold text-lg text-blue-700">{{ $stats['diverifikasi'] }}</div>Verifikasi</div>
<div class="bg-white p-3 rounded shadow"><div class="font-bold text-lg text-green-700">{{ $stats['diterima'] }}</div>Diterima</div>
<div class="bg-white p-3 rounded shadow"><div class="font-bold text-lg text-red-700">{{ $stats['ditolak'] }}</div>Ditolak</div>
</div>
<form method="GET" class="bg-white p-3 rounded shadow mb-3 flex flex-wrap gap-2 text-sm">
<input name="q" value="{{ request('q') }}" placeholder="Cari nama / nomor / sekolah" class="border rounded px-3 py-1 flex-1 min-w-[200px]">
<select name="status" class="border rounded px-2 py-1"><option value="">Semua status</option>@foreach(['pending','diverifikasi','diterima','ditolak'] as $s)<option value="{{ $s }}" @selected(request('status')==$s)>{{ $s }}</option>@endforeach</select>
<select name="jalur" class="border rounded px-2 py-1"><option value="">Semua jalur</option>@foreach(['reguler','prestasi','afirmasi'] as $j)<option value="{{ $j }}" @selected(request('jalur')==$j)>{{ $j }}</option>@endforeach</select>
<button class="px-4 py-1 bg-blue-900 text-white rounded">Filter</button>
</form>
<div class="bg-white rounded shadow overflow-x-auto">
<table class="w-full text-sm">
<thead class="bg-slate-100"><tr><th class="p-2 text-left">No</th><th class="p-2 text-left">Nama</th><th class="p-2 text-left">Asal Sekolah</th><th class="p-2">Jalur</th><th class="p-2">Status</th><th class="p-2">Aksi</th></tr></thead>
<tbody>
@forelse($pendaftar as $p)
<tr class="border-t">
<td class="p-2">{{ $p->no_pendaftaran }}</td>
<td class="p-2">{{ $p->nama_lengkap }}</td>
<td class="p-2">{{ $p->asal_sekolah }}</td>
<td class="p-2 text-center">{{ $p->jalur }}/{{ $p->gelombang }}</td>
<td class="p-2 text-center uppercase font-bold">{{ $p->status }}</td>
<td class="p-2 text-center"><a href="{{ route('admin.show', $p) }}" class="text-blue-700 underline">Detail</a></td>
</tr>
@empty
<tr><td colspan="6" class="p-4 text-center text-slate-500">Belum ada data.</td></tr>
@endforelse
</tbody>
</table>
</div>
<div class="mt-3">{{ $pendaftar->links() }}</div>
@endsection
