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
            $table->dropColumn(['file_rapor', 'tahun_lulus', 'rata_rata_rapor']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ppdb_registrations', function (Blueprint $table) {
            $table->string('tahun_lulus', 4)->nullable();
            $table->decimal('rata_rata_rapor', 4, 2)->nullable();
            $table->string('file_rapor')->nullable();
        });
    }
};
