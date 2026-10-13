@extends('layouts.ppdb')
@section('title', 'Biaya & Kalkulator SPMB 2027/2028')
@section('content')
<div class="bg-white p-6 rounded-2xl shadow">
<h1 class="font-extrabold text-navy-900 text-xl">Biaya SPMB 2027/2028</h1>
<p class="text-sm text-slate-600">DPP Rp8.000.000 • Seragam dkk Rp3.025.000 • SPP Juli 2027 Rp725.000 • Normal <b>Rp11.750.000</b></p>
<div class="grid md:grid-cols-2 gap-4 mt-4 text-sm">
<div class="border rounded-xl p-4"><div class="font-bold">Gelombang 1 (1 Okt–18 Des 2026)</div>
<ul class="mt-2 space-y-1"><li>YPSB 25% → DPP 6.000.000 → <b>Total 9.750.000</b> (5.850.000 + 3.900.000)</li><li>Suster 15% → DPP 6.800.000 → <b>Total 10.550.000</b> (6.330.000 + 4.220.000)</li><li>Umum 10% → DPP 7.200.000 → <b>Total 10.950.000</b> (6.570.000 + 4.380.000)</li></ul></div>
<div class="border rounded-xl p-4"><div class="font-bold">Gelombang 2 (4 Jan–31 Mar 2027)</div>
<ul class="mt-2 space-y-1"><li>Semua SMP 10% → DPP 7.200.000 → <b>Total 10.950.000</b> (6.570.000 + 4.380.000)</li><li>Pelunasan / angsuran II maks <b>31 Juli 2027</b></li></ul></div>
</div>
<div class="mt-4 border-t pt-4">
<h2 class="font-bold">Kalkulator Simulasi</h2>
<div class="grid md:grid-cols-4 gap-2 mt-2 text-sm">
<select id="kat" class="border rounded px-3 py-2"><option value="ypsb">SMP YPSB</option><option value="suster">SMP Suster</option><option value="umum" selected>SMP Umum</option></select>
<select id="gel" class="border rounded px-3 py-2"><option value="1" selected>Gelombang 1</option><option value="2">Gelombang 2</option></select>
<select id="skem" class="border rounded px-3 py-2"><option value="lunas">Lunas 1x</option><option value="angsuran">Angsuran 2x</option></select>
<button onclick="hitung()" class="bg-navy-900 text-white rounded px-4 py-2 font-bold">Hitung</button>
</div>
<div id="hasil" class="mt-2 text-sm bg-blue-50 border rounded-xl p-3">Pilih kategori & klik Hitung.</div>
</div>
<p class="text-xs text-slate-500 mt-3">Transfer: BNI 6617••••32 a.n. YPSB SMA STO PAULUS <button onclick="document.getElementById('rek').classList.toggle('hidden');this.remove()" class="underline text-blue-700">Tampilkan nomor lengkap</button> <span id="rek" class="hidden font-bold">BNI 6617710032</span>. Pastikan nama penerima benar & konfirmasi ke WA resmi. Tidak lunas hingga 31 Jul 2027 = mengundurkan diri & hangus. Mundur sepihak hangus 100%. Tidak lulus SMP kembali 100% (bawa SK + kwitansi).</p>
</div>
<script>
const T={};
T['1-ypsb']={dpp:6000000,total:9750000,a1:5850000,a2:3900000};
T['1-suster']={dpp:6800000,total:10550000,a1:6330000,a2:4220000};
T['1-umum']={dpp:7200000,total:10950000,a1:6570000,a2:4380000};
T['2-ypsb']={dpp:7200000,total:10950000,a1:6570000,a2:4380000};
T['2-suster']={dpp:7200000,total:10950000,a1:6570000,a2:4380000};
T['2-umum']={dpp:7200000,total:10950000,a1:6570000,a2:4380000};
function rp(n){return 'Rp'+n.toLocaleString('id-ID');}
function hitung(){
 const k=document.getElementById('gel').value+'-'+document.getElementById('kat').value;
 const s=document.getElementById('skem').value; const d=T[k];
 document.getElementById('hasil').innerHTML='DPP '+rp(d.dpp)+' + Seragam 3.025.000 + SPP 725.000 = <b>'+rp(d.total)+'</b><br>'+(s==='lunas'?'Bayar 1x: <b>'+rp(d.total)+'</b>':'Angsuran I: <b>'+rp(d.a1)+'</b> | Angsuran II: <b>'+rp(d.a2)+'</b>');
}
</script>
@endsection
