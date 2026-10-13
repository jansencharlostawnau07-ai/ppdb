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
        Schema::table('ppdb_registrations', function (Blueprint $table) {
            $table->string('asal_smp_kategori', 20)->default('umum')->after('asal_sekolah'); // ypsb|suster|umum
            $table->string('skema_bayar', 10)->default('lunas')->after('gelombang'); // lunas|angsuran
            $table->string('file_ktp_ortu')->nullable()->after('file_akta');
            $table->string('file_baptis')->nullable()->after('file_ktp_ortu');
            $table->string('file_rapor_8_ganjil')->nullable()->after('file_rapor');
            $table->string('file_rapor_8_genap')->nullable()->after('file_rapor_8_ganjil');
            $table->string('file_bukti_transfer')->nullable()->after('file_foto');
            $table->string('nama_bank', 20)->nullable()->after('file_bukti_transfer');
            $table->decimal('nominal_transfer', 12, 0)->nullable()->after('nama_bank');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ppdb_registrations', function (Blueprint $table) {
            $table->dropColumn([
                'asal_smp_kategori', 'skema_bayar',
                'file_ktp_ortu', 'file_baptis',
                'file_rapor_8_ganjil', 'file_rapor_8_genap',
                'file_bukti_transfer', 'nama_bank', 'nominal_transfer',
            ]);
        });
    }
};
