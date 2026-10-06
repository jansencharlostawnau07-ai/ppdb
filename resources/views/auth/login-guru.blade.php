<!DOCTYPE html>
<html lang="id">
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Login Guru — SMA Santo Paulus</title><script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script></head>
<body class="min-h-screen bg-slate-950 text-white flex items-center justify-center p-4">
<div class="w-full max-w-md bg-white text-slate-900 rounded-3xl p-6 sm:p-8">
    <a href="/login" class="text-sm text-emerald-700 font-semibold">← Ganti peran</a>
    <div class="flex items-center gap-3 mt-2"><div class="w-12 h-12 rounded-2xl bg-emerald-600 text-white flex items-center justify-center text-2xl">◧</div><div><p class="font-bold text-lg">Login Guru</p><p class="text-xs text-slate-500">NIP + PIN sekolah</p></div></div>
    @if($errors->any())<div class="mt-4 bg-red-50 border border-red-200 text-red-700 text-sm rounded-xl px-4 py-3">{{ $errors->first() }}</div>@endif
    <form method="POST" action="/login/guru" class="mt-5 space-y-3">
        @csrf
        <div><label class="text-xs font-bold">NIP</label><input name="nip" value="{{ old('nip','19850101') }}" required class="mt-1 w-full border rounded-xl px-4 py-3 text-sm" placeholder="cth: 19850101"></div>
        <div><label class="text-xs font-bold">Password</label><input name="password" type="password" required class="mt-1 w-full border rounded-xl px-4 py-3 text-sm" placeholder="demo: guru123"></div>
        <div><label class="text-xs font-bold">PIN Sekolah</label><input name="pin" value="1234" required maxlength="4" class="mt-1 w-full border rounded-xl px-4 py-3 text-sm text-center font-bold tracking-[0.5em]" placeholder="••••"></div>
        <button class="w-full py-3.5 bg-emerald-600 text-white font-bold rounded-xl">Masuk sebagai Guru →</button>
    </form>
    <p class="text-xs text-slate-500 mt-4 text-center">Demo — NIP: <b>19850101</b> / password: <b>guru123</b> / PIN: <b>1234</b><br>Bukan guru? <a href="/login/siswa" class="underline font-semibold">Login Murid</a></p>
</div>
</body>
</html>
