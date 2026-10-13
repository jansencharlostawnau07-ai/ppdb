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
        'asal_sekolah', 'tahun_lulus', 'rata_rata_rapor',
        'nama_ayah', 'pekerjaan_ayah', 'nama_ibu', 'pekerjaan_ibu', 'no_hp_ortu',
        'jalur', 'gelombang', 'status', 'catatan_admin',
        'file_kk', 'file_akta', 'file_rapor', 'file_foto',
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
