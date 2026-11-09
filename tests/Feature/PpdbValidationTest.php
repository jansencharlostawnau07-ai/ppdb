<?php

namespace Tests\Feature;

use App\Models\PpdbRegistration;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PpdbValidationTest extends TestCase
{
    use RefreshDatabase;

    private function actingAsApplicant(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        return $user;
    }

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
            'jalur' => 'reguler',
            'gelombang' => '1',
            'skema_bayar' => 'lunas',
        ], $overrides);
    }

    private function step2Data(array $overrides = []): array
    {
        return array_merge([
            'nama_ayah' => 'Ayah Uji',
            'pekerjaan_ayah' => 'PNS',
            'nama_ibu' => 'Ibu Uji',
            'pekerjaan_ibu' => 'Ibu Rumah Tangga',
            'no_hp_ortu' => '081200000002',
        ], $overrides);
    }

    public function test_nik_pendek_ditolak(): void
    {
        $this->actingAsApplicant();
        $response = $this->post('/daftar/1', $this->step1Data(['nik' => '12345678901234']));

        $response->assertSessionHasErrors('nik');
        $this->assertDatabaseCount('ppdb_registrations', 0);
    }

    public function test_nisn_pendek_ditolak(): void
    {
        $this->actingAsApplicant();
        $response = $this->post('/daftar/1', $this->step1Data(['nisn' => '12345']));

        $response->assertSessionHasErrors('nisn');
        $this->assertDatabaseCount('ppdb_registrations', 0);
    }

    public function test_nik_tanggal_tidak_cocok_ditolak(): void
    {
        $this->actingAsApplicant();
        $response = $this->post('/daftar/1', $this->step1Data(['nik' => '6171010101900001']));

        $response->assertSessionHasErrors('nik');
        $this->assertDatabaseCount('ppdb_registrations', 0);
    }

    public function test_nik_valid_lolos(): void
    {
        $this->actingAsApplicant();
        $response = $this->post('/daftar/1', $this->step1Data(['nik' => '6171011005110001']));

        $response->assertRedirect();
        $this->assertDatabaseCount('ppdb_registrations', 0);
    }

    public function test_draft_persists_between_steps(): void
    {
        $this->actingAsApplicant();
        $this->post('/daftar/1', $this->step1Data(['nama_lengkap' => 'Test Draft']));
        $response = $this->get('/daftar/2');
        $response->assertStatus(200);
        $response->assertSee('Step 2');
        $this->assertDatabaseHas('ppdb_drafts', ['user_id' => auth()->id()]);
    }

    public function test_nisn_duplikat_ditolak(): void
    {
        $this->actingAsApplicant();
        PpdbRegistration::create(array_merge($this->step1Data(), [
            'no_pendaftaran' => 'PPDB-2027-9998',
            'status' => 'pending',
        ]));

        $response = $this->post('/daftar/1', $this->step1Data(['nisn' => '0012345678', 'nik' => '6171011005110002']));

        $response->assertSessionHasErrors(['nisn' => 'NIK atau NISN Anda sudah terdaftar, Mohon untuk diperiksa kembali']);
        $this->assertDatabaseCount('ppdb_registrations', 1);
    }

    public function test_nik_duplikat_ditolak(): void
    {
        $this->actingAsApplicant();
        PpdbRegistration::create(array_merge($this->step1Data(), [
            'no_pendaftaran' => 'PPDB-2027-9999',
            'status' => 'pending',
        ]));

        $response = $this->post('/daftar/1', $this->step1Data(['nik' => '6171011005110001', 'nisn' => '0012345679']));

        $response->assertSessionHasErrors(['nik' => 'NIK atau NISN Anda sudah terdaftar, Mohon untuk diperiksa kembali']);
        $this->assertDatabaseCount('ppdb_registrations', 1);
    }

    public function test_foto_bukan_gambar_ditolak(): void
    {
        Storage::fake('public');
        $this->actingAsApplicant();

        $this->post('/daftar/1', $this->step1Data())->assertRedirect();
        $this->post('/daftar/2', $this->step2Data())->assertRedirect();
        $response = $this->post('/daftar/3', [
            'file_foto' => UploadedFile::fake()->create('palsu.pdf', 100),
        ]);

        $response->assertSessionHasErrors('file_foto');
        $this->assertDatabaseCount('ppdb_registrations', 0);
    }

    public function test_multi_step_sampai_submit(): void
    {
        Storage::fake('public');
        $user = $this->actingAsApplicant();

        $this->post('/daftar/1', $this->step1Data())->assertRedirect();
        $this->post('/daftar/2', $this->step2Data())->assertRedirect();
        $this->post('/daftar/3', [])->assertRedirect();
        $this->post('/daftar/4', ['nominal_transfer' => 9750000])->assertRedirect(route('ppdb.daftar.submit.form'));

        $response = $this->post('/daftar/submit');

        $response->assertRedirect();
        $this->assertDatabaseCount('ppdb_registrations', 1);
        $this->assertDatabaseHas('ppdb_registrations', [
            'nama_lengkap' => 'Siswa Uji',
            'nominal_bayar' => '9750000',
            'user_id' => $user->id,
        ]);
        $this->assertDatabaseMissing('ppdb_drafts', ['user_id' => $user->id]);
    }

    public function test_halaman_submit_tercapai(): void
    {
        $this->actingAsApplicant();
        $this->post('/daftar/1', $this->step1Data());
        $response = $this->get('/daftar/submit');
        $response->assertOk();
    }

    public function test_tamu_diarahkan_ke_login_pendaftar(): void
    {
        $response = $this->get('/daftar/1');
        $response->assertRedirect(route('ppdb.login'));
    }
}
