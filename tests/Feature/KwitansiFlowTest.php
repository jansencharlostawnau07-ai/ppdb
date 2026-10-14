<?php

namespace Tests\Feature;

use App\Models\PpdbRegistration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KwitansiFlowTest extends TestCase
{
    use RefreshDatabase;

    private function daftarDiterima(): PpdbRegistration
    {
        return PpdbRegistration::create([
            'no_pendaftaran' => 'PPDB-2027-0007',
            'nama_lengkap' => 'Siswa Kwitansi',
            'jenis_kelamin' => 'P',
            'tanggal_lahir' => '2011-08-20',
            'alamat' => 'Jl Uji',
            'no_hp' => '081200000007',
            'asal_sekolah' => 'SMP Uji',
            'asal_smp_kategori' => 'umum',
            'jalur' => 'reguler',
            'gelombang' => '1',
            'skema_bayar' => 'lunas',
            'status' => 'diterima',
            'no_kwitansi' => 'KW-2027-00007',
        ]);
    }

    public function test_kwitansi_tanpa_sesi_ditolak(): void
    {
        $p = $this->daftarDiterima();

        $this->get("/kwitansi/{$p->no_pendaftaran}")->assertRedirect('/cek-status');
    }

    public function test_cek_lalu_kwitansi_bisa(): void
    {
        $p = $this->daftarDiterima();

        $this->post('/cek-status', [
            'no_pendaftaran' => $p->no_pendaftaran,
            'tanggal_lahir' => '2011-08-20',
        ])->assertOk();

        $this->get("/kwitansi/{$p->no_pendaftaran}")->assertOk();
        $this->get("/kartu/{$p->no_pendaftaran}")->assertOk();
    }

    public function test_belum_diterima_tidak_bisa_kwitansi(): void
    {
        $p = $this->daftarDiterima();
        $p->update(['status' => 'pending']);

        $this->post('/cek-status', [
            'no_pendaftaran' => $p->no_pendaftaran,
            'tanggal_lahir' => '2011-08-20',
        ])->assertOk();

        $this->get("/kwitansi/{$p->no_pendaftaran}")->assertRedirect('/cek-status');
    }
}
