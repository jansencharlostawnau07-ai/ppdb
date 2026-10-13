<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ppdb_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('no_pendaftaran')->unique();
            // Data siswa
            $table->string('nama_lengkap');
            $table->string('nisn', 20)->nullable();
            $table->string('nik', 25)->nullable();
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir');
            $table->string('agama', 30)->nullable();
            $table->text('alamat');
            $table->string('no_hp', 20);
            $table->string('email')->nullable();
            // Asal sekolah
            $table->string('asal_sekolah');
            $table->string('tahun_lulus', 4)->nullable();
            $table->decimal('rata_rata_rapor', 4, 2)->nullable();
            // Orang tua
            $table->string('nama_ayah')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->string('no_hp_ortu', 20)->nullable();
            // Pendaftaran
            $table->string('jalur', 20)->default('reguler'); // reguler|prestasi|afirmasi
            $table->string('gelombang', 10)->default('1');
            $table->string('status', 20)->default('pending'); // pending|diverifikasi|diterima|ditolak
            $table->text('catatan_admin')->nullable();
            // Berkas
            $table->string('file_kk')->nullable();
            $table->string('file_akta')->nullable();
            $table->string('file_rapor')->nullable();
            $table->string('file_foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppdb_registrations');
    }
};
