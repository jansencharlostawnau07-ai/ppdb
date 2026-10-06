<!DOCTYPE html>
<html lang="id">
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Login Murid — SMA Santo Paulus</title><script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script></head>
<body class="min-h-screen bg-gradient-to-br from-blue-50 to-amber-50 flex items-center justify-center p-4">
<div class="w-full max-w-md bg-white rounded-3xl border shadow-xl p-6 sm:p-8">
    <a href="/login" class="text-sm text-blue-800 font-semibold">← Ganti peran</a>
    <div class="flex items-center gap-3 mt-2"><div class="w-12 h-12 rounded-2xl bg-blue-800 text-white flex items-center justify-center text-2xl">🎒</div><div><p class="font-bold text-lg">Login Murid</p><p class="text-xs text-slate-500">NIS + password</p></div></div>
    @if($errors->any())<div class="mt-4 bg-red-50 border border-red-200 text-red-700 text-sm rounded-xl px-4 py-3">{{ $errors->first() }}</div>@endif
    <form method="POST" action="/login/siswa" class="mt-5 space-y-3">
        @csrf
        <div><label class="text-xs font-bold">NIS</label><input name="nis" value="{{ old('nis','20261001') }}" required class="mt-1 w-full border rounded-xl px-4 py-3 text-sm" placeholder="cth: 20261001"></div>
        <div><label class="text-xs font-bold">Password</label><input name="password" type="password" required class="mt-1 w-full border rounded-xl px-4 py-3 text-sm" placeholder="demo: siswa123"></div>
        <button class="w-full py-3.5 bg-blue-800 text-white font-bold rounded-xl">Masuk sebagai Murid →</button>
    </form>
    <p class="text-xs text-slate-500 mt-4 text-center">Demo — NIS: <b>20261001</b> / password: <b>siswa123</b><br>Bukan murid? <a href="/login/guru" class="underline font-semibold">Login Guru</a></p>
</div>
</body>
</html>
