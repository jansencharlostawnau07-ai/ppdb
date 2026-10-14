<?php

namespace Tests\Feature;

use App\Models\PpdbRegistration;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPpdbTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return User::factory()->create(['email' => 'admin@smasantopaulus.sch.id']);
    }

    private function daftar(): PpdbRegistration
    {
        return PpdbRegistration::create([
            'no_pendaftaran' => 'PPDB-2027-0001',
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
            'status' => 'pending',
        ]);
    }

    public function test_admin_bisa_ubah_data(): void
    {
        $p = $this->daftar();

        $response = $this->actingAs($this->admin())->put("/admin/pendaftar/{$p->id}", [
            'nama_lengkap' => 'Siswa Uji Revisi',
            'jenis_kelamin' => 'L',
            'tanggal_lahir' => '2011-05-10',
            'alamat' => 'Jl Uji',
            'no_hp' => '081200000002',
            'asal_sekolah' => 'SMP Uji',
            'asal_smp_kategori' => 'ypsb',
            'jalur' => 'reguler',
            'gelombang' => '1',
            'skema_bayar' => 'angsuran',
            'nominal_bayar' => 5850000,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('ppdb_registrations', ['id' => $p->id, 'nama_lengkap' => 'Siswa Uji Revisi', 'nominal_bayar' => 5850000]);
    }

    public function test_diterima_terbit_kwitansi(): void
    {
        $p = $this->daftar();

        $this->actingAs($this->admin())->patch("/admin/pendaftar/{$p->id}/status", [
            'status' => 'diterima',
        ]);

        $this->assertNotNull($p->fresh()->no_kwitansi);
    }

    public function test_tamu_ditolak_di_admin(): void
    {
        $p = $this->daftar();

        $this->get('/admin')->assertRedirect('/admin/login');
        $this->get("/admin/pendaftar/{$p->id}")->assertRedirect('/admin/login');
    }
}
