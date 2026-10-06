@extends('layouts.app')
@section('title', 'PPDB 2026/2027 SMA Santo Paulus — Alur, Jadwal, Biaya & Formulir')
@section('content')

{{-- HERO PPDB --}}
<section class="bg-slate-900 text-white">
    <div class="max-w-7xl mx-auto px-4 py-12">
        <p class="text-xs font-bold tracking-widest text-amber-400">PENERIMAAN PESERTA DIDIK BARU 2026/2027</p>
        <h1 class="text-3xl sm:text-4xl font-bold mt-2">Daftar 15 Menit dari Rumah. Kami Dampingi Sampai Tuntas.</h1>
        <p class="text-slate-300 text-sm sm:text-base mt-3 max-w-2xl">Isi formulir online, upload rapor & KK, ikut tes, daftar ulang. Panitia standby via WhatsApp setiap hari kerja 08.00–15.00.</p>
        <div class="mt-6 flex flex-col sm:flex-row gap-3">
            <a href="#formulir" class="text-center px-6 py-3.5 bg-amber-400 text-slate-900 font-bold rounded-xl">Isi Formulir Daring →</a>
            <a href="https://wa.me/6281549168579?text=Halo%20Panitia%20PPDB%20SMA%20Santo%20Paulus,%20saya%20ingin%20bertanya." class="text-center px-6 py-3.5 border border-white/30 rounded-xl">Chat Panitia via WA</a>
        </div>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 py-10 space-y-10">

    {{-- ALUR + SYARAT --}}
    <section class="grid lg:grid-cols-2 gap-6">
        <div class="bg-white border rounded-2xl p-6">
            <h2 class="font-bold text-xl">Alur Pendaftaran (4 Langkah)</h2>
            <ol class="mt-4 space-y-3 text-sm">
                @foreach([
                    ['1','Isi Formulir Online','5 menit. Data siswa + asal sekolah. Langsung dapat nomor pendaftaran via WA.'],
                    ['2','Upload Berkas','Rapor semester 1–5, KK, Akta, pas foto. Boleh susulan saat daftar ulang.'],
                    ['3','Tes & Wawancara','Tes TPA + literasi 90 menit + wawancara orang tua 15 menit.'],
                    ['4','Daftar Ulang','Bayar uang pangkal (bisa cicil 3x) dan ukur seragam. Resmi jadi siswa.'],
                ] as [$n,$t,$d])
                <li class="flex gap-3"><span class="w-8 h-8 shrink-0 rounded-full bg-blue-800 text-white flex items-center justify-center font-bold">{{ $n }}</span><div><p class="font-bold">{{ $t }}</p><p class="text-slate-500">{{ $d }}</p></div></li>
                @endforeach
            </ol>
        </div>
        <div class="bg-white border rounded-2xl p-6">
            <h2 class="font-bold text-xl">Syarat Dokumen ✓</h2>
            <ul class="mt-4 space-y-2.5 text-sm">
                <li class="flex gap-2"><span>✅</span> Fotokopi rapor semester 1–5 (min. rata-rata 75)</li>
                <li class="flex gap-2"><span>✅</span> Kartu Keluarga & Akta Kelahiran</li>
                <li class="flex gap-2"><span>✅</span> Pas foto 3x4 (4 lembar / file JPG)</li>
                <li class="flex gap-2"><span>✅</span> Surat baptis <span class="text-slate-500">(bila Katolik — tidak wajib)</span></li>
                <li class="flex gap-2"><span>✅</span> Sertifikat prestasi <span class="text-slate-500">(bila ada, untuk jalur bebas tes)</span></li>
            </ul>
            <div class="mt-4 bg-blue-50 border border-blue-100 rounded-xl p-4 text-sm"><b>Non-Katolik bisa mendaftar?</b> Sangat bisa. 30% siswa kami lintas agama.</div>
        </div>
    </section>

    {{-- JADWAL + BIAYA --}}
    <section id="jadwal" class="grid lg:grid-cols-2 gap-6">
        <div class="bg-white border rounded-2xl p-6 overflow-x-auto">
            <h2 class="font-bold text-xl">Jadwal Pelaksanaan</h2>
            <table class="w-full text-sm mt-4 min-w-[520px]">
                <thead><tr class="text-left text-slate-500 border-b"><th class="py-2">Gelombang</th><th>Periode</th><th>Tes</th><th>Pengumuman</th></tr></thead>
                <tbody>
                    <tr class="border-b"><td class="py-3 font-bold">1 — Early Bird <span class="text-[11px] bg-green-100 text-green-800 px-2 py-0.5 rounded-full">Bebas Formulir</span></td><td>6 Okt – 20 Des 2025</td><td>13 Des 2025</td><td>18 Des 2025</td></tr>
                    <tr class="border-b"><td class="py-3 font-bold">2 — Reguler</td><td>5 Jan – 28 Feb 2026</td><td>7 Mar 2026</td><td>12 Mar 2026</td></tr>
                    <tr><td class="py-3 font-bold">3 — Terakhir*</td><td>10 Mar – 30 Apr 2026</td><td>9 Mei 2026</td><td>14 Mei 2026</td></tr>
                </tbody>
            </table>
            <p class="text-xs text-slate-500 mt-3">*Gelombang 3 dibuka bila kuota tersisa.</p>
        </div>
        <div class="bg-white border rounded-2xl p-6">
            <h2 class="font-bold text-xl">Rincian Biaya (Transparan)</h2>
            <dl class="text-sm mt-4 space-y-2">
                <div class="flex justify-between border-b pb-2"><dt>Formulir (Gel. 1)</dt><dd class="font-bold text-green-700">GRATIS</dd></div>
                <div class="flex justify-between border-b pb-2"><dt>Formulir (Gel. 2/3)</dt><dd class="font-bold">Rp250.000</dd></div>
                <div class="flex justify-between border-b pb-2"><dt>Uang pangkal</dt><dd class="font-bold">Mulai Rp5 jt <span class="font-normal text-slate-500">(cicil 3x)</span></dd></div>
                <div class="flex justify-between"><dt>SPP / bulan</dt><dd class="font-bold">Rp950 rb <span class="font-normal text-slate-500">(termasuk E-Learning)</span></dd></div>
            </dl>
            <div class="flex gap-2 mt-4">
                <a href="#" class="flex-1 text-center px-4 py-3 border rounded-xl text-sm font-semibold">Unduh Brosur PDF</a>
                <a href="https://wa.me/6281549168579" class="flex-1 text-center px-4 py-3 bg-green-600 text-white rounded-xl text-sm font-bold">Kontak Panitia</a>
            </div>
        </div>
    </section>

    {{-- FORMULIR CTA --}}
    <section id="formulir" class="bg-blue-800 text-white rounded-2xl p-6 sm:p-10 grid lg:grid-cols-2 gap-8 items-center">
        <div>
            <p class="text-amber-300 font-bold text-sm">KUOTA 2026: 288 KURSI • 8 ROMBEL</p>
            <h2 class="text-2xl sm:text-3xl font-bold mt-2">Siap Bergabung dengan Keluarga Santo Paulus?</h2>
            <p class="text-blue-100 text-sm mt-2">Klik tombol di samping, isi 5 menit, nomor pendaftaran otomatis terkirim ke WhatsApp Anda.</p>
            <ul class="text-sm mt-4 space-y-1 text-blue-100"><li>✓ Tidak perlu datang dulu</li><li>✓ Bisa simpan & lanjutkan nanti</li><li>✓ Didampingi panitia live-chat</li></ul>
        </div>
        <form class="bg-white text-slate-900 rounded-2xl p-6 space-y-3" onsubmit="return false;">
            <p class="font-bold">Formulir Pra-Pendaftaran (Demo UI)</p>
            <input required placeholder="Nama lengkap calon siswa" class="w-full border rounded-xl px-4 py-3 text-sm">
            <div class="grid grid-cols-2 gap-3">
                <input required placeholder="Asal sekolah (SMP)" class="border rounded-xl px-4 py-3 text-sm">
                <select class="border rounded-xl px-4 py-3 text-sm"><option>Jalur Reguler</option><option>Jalur Prestasi</option><option>Jalur Afirmasi</option></select>
            </div>
            <input required placeholder="No. WhatsApp aktif (08xx)" class="w-full border rounded-xl px-4 py-3 text-sm">
            <button class="w-full py-3.5 bg-amber-400 font-bold rounded-xl">Kirim & Dapat Nomor Pendaftaran →</button>
            <p class="text-xs text-slate-500 text-center">Data aman. Hanya digunakan untuk keperluan PPDB.</p>
        </form>
    </section>

    {{-- FAQ --}}
    <section id="faq" class="bg-white border rounded-2xl p-6">
        <h2 class="font-bold text-xl">Pertanyaan yang Sering Ditanyakan</h2>
        <div class="mt-4 divide-y text-sm">
            @foreach([
                ['Apakah ada jalur prestasi tanpa tes tulis?','Ya. Rata-rata rapor 90+ atau juara kabupaten/provinsi bebas tes tulis, cukup wawancara + verifikasi sertifikat.'],
                ['Apakah siswa non-Katolik boleh daftar?','Boleh. 30% siswa kami lintas agama. Pelajaran agama mengikuti agama masing-masing.'],
                ['Bagaimana jika kesulitan upload berkas?','Tetap submit formulir dulu. Berkas boleh susulan via WA panitia atau saat daftar ulang.'],
                ['Apakah ada asrama?','Belum ada asrama, tapi kami bekerja sama dengan 4 kos bina asuh dalam radius 500 m dengan pendampingan kesiswaan.'],
                ['Apakah uang pangkal bisa dicicil?','Bisa, hingga 3x tanpa bunga. Ada juga beasiswa prestasi 25–100% untuk Gelombang 1.'],
            ] as [$q,$a])
            <div>
                <button data-faq-btn class="w-full text-left py-4 font-semibold flex justify-between gap-4">{{ $q }} <span>+</span></button>
                <div data-faq-panel class="hidden pb-4 text-slate-600">{{ $a }}</div>
            </div>
            @endforeach
        </div>
    </section>

</div>
@endsection
