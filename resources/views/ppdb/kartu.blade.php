<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Kartu Calon Peserta Didik Baru - {{ $pendaftaran->no_pendaftaran }}</title>
<style>
body{font-family:Arial,sans-serif; margin:24px; color:#111}
.card{border:2px solid #172e6e; border-radius:12px; padding:20px; max-width:640px}
.head{display:flex; align-items:center; gap:12px; border-bottom:2px solid #172e6e; padding-bottom:12px}
.head img{width:64px; height:64px; object-fit:contain}
h1{font-size:18px; margin:0; color:#172e6e}
.sub{font-size:12px; color:#444}
table{width:100%; font-size:13px; margin-top:12px; border-collapse:collapse}
td{padding:5px 4px; vertical-align:top}
.no{font-size:22px; font-weight:bold; letter-spacing:2px; color:#172e6e}
.box{background:#f1f5f9; border-radius:8px; padding:10px; font-size:12px; margin-top:12px}
@media print{ .noprint{display:none} }
</style>
</head>
<body>
<div class="card">
<div class="head">
<img src="{{ asset('images/logo-sekolah.png') }}" alt="Logo">
<div><h1>KARTU CALON PESERTA DIDIK BARU</h1><div class="sub">SMA Santo Paulus Pontianak • SPMB 2027/2028</div></div>
</div>
<div class="no">{{ $pendaftaran->no_pendaftaran }}</div>
<table>
<tr><td width="160">Nama</td><td><b>{{ $pendaftaran->nama_lengkap }}</b></td></tr>
<tr><td>Asal SMP</td><td>{{ $pendaftaran->asal_sekolah }} [{{ $pendaftaran->asal_smp_kategori }}]</td></tr>
<tr><td>Jalur / Gelombang</td><td>{{ $pendaftaran->jalur }} / {{ $pendaftaran->gelombang }}</td></tr>
<tr><td>Skema</td><td>{{ $pendaftaran->skema_bayar }}</td></tr>
<tr><td>Tanggal Daftar</td><td>{{ $pendaftaran->created_at->format('d M Y H:i') }}</td></tr>
</table>
<div class="box">Simpan kartu ini + bukti transfer untuk pengukuran seragam (vendor / WA) dan masuk Grup WA Ortu. Kwitansi resmi diterbitkan panitia setelah verifikasi pembayaran.</div>
<div class="noprint" style="margin-top:12px"><button onclick="window.print()">Cetak / Simpan PDF</button></div>
</div>
</body>
</html>
