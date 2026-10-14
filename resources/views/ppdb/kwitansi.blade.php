<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Kwitansi - {{ $pendaftaran->no_kwitansi ?? $pendaftaran->no_pendaftaran }}</title>
<style>
body{font-family:Arial,sans-serif; margin:24px; color:#111}
.kw{border:2px solid #172e6e; border-radius:12px; padding:20px; max-width:640px}
.head{display:flex; align-items:center; gap:12px; border-bottom:2px solid #172e6e; padding-bottom:12px}
.head img{width:64px; height:64px; object-fit:contain}
h1{font-size:18px; margin:0; color:#172e6e}
.sub{font-size:12px; color:#444}
table{width:100%; font-size:13px; margin-top:12px; border-collapse:collapse}
td{padding:5px 4px; vertical-align:top}
.no{font-size:16px; font-weight:bold; color:#172e6e}
.ttd{display:flex; justify-content:space-between; margin-top:32px; font-size:13px}
@media print{ .noprint{display:none} }
</style>
</head>
<body>
<div class="kw">
<div class="head">
<img src="{{ asset('images/logo-sekolah.png') }}" alt="Logo">
<div><h1>KWITANSI PEMBAYARAN SPMB</h1><div class="sub">SMA Santo Paulus Pontianak • TA 2027/2028</div></div>
</div>
<div class="no">No: {{ $pendaftaran->no_kwitansi ?? '-' }}</div>
<table>
<tr><td width="170">Telah diterima dari</td><td><b>{{ $pendaftaran->nama_lengkap }}</b> ({{ $pendaftaran->no_pendaftaran }})</td></tr>
<tr><td>Asal SMP</td><td>{{ $pendaftaran->asal_sekolah }}</td></tr>
<tr><td>Skema / Gelombang</td><td>{{ $pendaftaran->skema_bayar }} / {{ $pendaftaran->gelombang }}</td></tr>
<tr><td>Nominal terverifikasi</td><td><b>Rp{{ number_format($pendaftaran->nominal_bayar ?? 0, 0, ',', '.') }}</b></td></tr>
<tr><td>Rekening tujuan</td><td>BNI 6617710032 a.n. YPSB SMA STO PAULUS</td></tr>
</table>
<div class="ttd"><div>Pontianak, ___ / ___ / 20___<br><br><br>(___________________)<br>Panitia SPMB</div><div>Catatan: {{ $pendaftaran->catatan_admin ?? '-' }}</div></div>
<div class="noprint" style="margin-top:12px"><button onclick="window.print()">Cetak / Simpan PDF</button></div>
</div>
</body>
</html>
