<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PpdbValidationTest extends TestCase
{
    use RefreshDatabase;

    private function baseData(array $overrides = []): array
    {
        return array_merge([
            'nama_lengkap' => 'Siswa Uji',
            'jenis_kelamin' => 'L',
            'tanggal_lahir' => '2011-05-10',
            'alamat' => 'Jl Uji',
            'no_hp' => '081200000001',
            'asal_sekolah' => 'SMP Uji',
            'asal_smp_kategori' => 'umum',
            'jalur' => 'reguler',
            'gelombang' => '1',
            'skema_bayar' => 'lunas',
        ], $overrides);
    }

    public function test_nik_pendek_ditolak(): void
    {
        $response = $this->post('/daftar', $this->baseData(['nik' => '12345678901234']));

        $response->assertSessionHasErrors('nik');
        $this->assertDatabaseCount('ppdb_registrations', 0);
    }

    public function test_nisn_pendek_ditolak(): void
    {
        $response = $this->post('/daftar', $this->baseData(['nisn' => '12345']));

        $response->assertSessionHasErrors('nisn');
        $this->assertDatabaseCount('ppdb_registrations', 0);
    }

    public function test_nik_tanggal_tidak_cocok_ditolak(): void
    {
        // digit 7-12 = 010190, lahir diinput 2011-05-10 -> mismatch
        $response = $this->post('/daftar', $this->baseData(['nik' => '6171010101900001']));

        $response->assertSessionHasErrors('nik');
        $this->assertDatabaseCount('ppdb_registrations', 0);
    }

    public function test_nik_valid_lolos(): void
    {
        // Pontianak 617101 + 100511 (10-05-11) + 0001
        $response = $this->post('/daftar', $this->baseData(['nik' => '6171011005110001']));

        $response->assertRedirect();
        $this->assertDatabaseCount('ppdb_registrations', 1);
    }
}
