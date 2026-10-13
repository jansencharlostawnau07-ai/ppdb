@extends('layouts.ppdb')
@section('title', 'Login Admin')
@section('content')
<div class="bg-white p-6 rounded shadow max-w-md mx-auto">
<h1 class="font-bold text-blue-900 mb-1">Login Admin PPDB</h1>
<p class="text-xs text-slate-500 mb-3">Default: admin@smasantopaulus.sch.id / ppdb123 (ganti setelah serah terima)</p>
<form method="POST" action="{{ route('admin.login.post') }}" class="space-y-3 text-sm">
@csrf
<div><label class="font-semibold">Email</label><input type="email" name="email" value="{{ old('email') }}" required class="w-full border rounded px-3 py-2"></div>
<div><label class="font-semibold">Password</label><input type="password" name="password" required class="w-full border rounded px-3 py-2"></div>
<button class="w-full py-2 bg-blue-900 text-white rounded font-bold">Masuk</button>
</form>
</div>
@endsection
