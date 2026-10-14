<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpdbRegistration extends Model
{
    protected $fillable = [
        'no_pendaftaran',
        'nama_lengkap', 'nisn', 'nik', 'jenis_kelamin',
        'tempat_lahir', 'tanggal_lahir', 'agama',
        'alamat', 'no_hp', 'email',
        'asal_sekolah', 'asal_smp_kategori',
        'nama_ayah', 'pekerjaan_ayah', 'nama_ibu', 'pekerjaan_ibu', 'no_hp_ortu',
        'jalur', 'gelombang', 'skema_bayar', 'status', 'catatan_admin',
        'file_kk', 'file_akta', 'file_ktp_ortu', 'file_baptis',
        'file_rapor_8_ganjil', 'file_rapor_8_genap',
        'file_foto', 'file_bukti_transfer', 'nama_bank',
        'no_kwitansi', 'nominal_bayar',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public static function generateNoPendaftaran(): string
    {
        $year = date('Y');
        $count = (int) static::whereYear('created_at', $year)->count() + 1;
        return sprintf('PPDB-%s-%04d', $year, $count);
    }
}
