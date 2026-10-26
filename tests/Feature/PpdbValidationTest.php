<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PpdbValidationTest extends TestCase
{
    use RefreshDatabase;

    private function step1Data(array $overrides = []): array
    {
        return array_merge([
            'nama_lengkap' => 'Siswa Uji',
            'nisn' => '0012345678',
            'nik' => '6171011005110001',
            'jenis_kelamin' => 'L',
            'tempat_lahir' => 'Pontianak',
            'tanggal_lahir' => '2011-05-10',
            'agama' => 'Katolik',
            'alamat' => 'Jl Uji',
            'no_hp' => '081200000001',
            'email' => 'siswa@example.com',
            'asal_sekolah' => 'SMP Uji',
            'asal_smp_kategori' => 'umum',
            'tahun_lulus' => '2026',
            'rata_rata_rapor' => '85.00',
            'jalur' => 'reguler',
            'gelombang' => '1',
            'skema_bayar' => 'lunas',
        ], $overrides);
    }

    public function test_nik_pendek_ditolak(): void
    {
        $response = $this->post('/daftar/1', $this->step1Data(['nik' => '12345678901234']));

        $response->assertSessionHasErrors('nik');
        $this->assertDatabaseCount('ppdb_registrations', 0);
    }

    public function test_nisn_pendek_ditolak(): void
    {
        $response = $this->post('/daftar/1', $this->step1Data(['nisn' => '12345']));

        $response->assertSessionHasErrors('nisn');
        $this->assertDatabaseCount('ppdb_registrations', 0);
    }

    public function test_nik_tanggal_tidak_cocok_ditolak(): void
    {
        $response = $this->post('/daftar/1', $this->step1Data(['nik' => '6171010101900001']));

        $response->assertSessionHasErrors('nik');
        $this->assertDatabaseCount('ppdb_registrations', 0);
    }

    public function test_nik_valid_lolos(): void
    {
        $response = $this->post('/daftar/1', $this->step1Data(['nik' => '6171011005110001']));

        $response->assertRedirect();
        $this->assertDatabaseCount('ppdb_registrations', 0);
    }

    public function test_session_persists_between_steps(): void
    {
        $this->post('/daftar/1', $this->step1Data(['nama_lengkap' => 'Test Session']));
        $response = $this->get('/daftar/2');
        $response->assertStatus(200);
    }
}
