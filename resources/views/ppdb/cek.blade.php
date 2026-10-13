@extends('layouts.ppdb')
@section('title', 'Cek Status')
@section('content')
<div class="bg-white p-6 rounded shadow max-w-lg mx-auto">
<h1 class="font-bold text-blue-900 mb-3">Cek Status Pendaftaran</h1>
<form method="POST" action="{{ route('ppdb.cek') }}" class="space-y-3 text-sm">
@csrf
<div><label class="font-semibold">Nomor Pendaftaran *</label><input name="no_pendaftaran" value="{{ old('no_pendaftaran') }}" placeholder="PPDB-2026-0001" required class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">Tanggal Lahir *</label><input type="date" name="tanggal_lahir" required class="w-full border rounded px-3 py-2"></div>
<button class="px-5 py-2 bg-blue-900 text-white rounded font-bold">Cek</button>
</form>
</div>
@endsection
