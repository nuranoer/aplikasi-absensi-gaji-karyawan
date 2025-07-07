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
        Schema::create('slip_gaji', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karyawan_id')->constrained('karyawan');
            $table->integer('periode_bulan');
            $table->integer('periode_tahun');
            $table->integer('hari_kerja');
            $table->integer('izin');
            $table->integer('sakit');
            $table->integer('cuti');
            $table->decimal('gaji_pokok', 20, 2);
            $table->decimal('tunjangan', 20, 2)->default(0);
            $table->decimal('potongan', 20, 2)->default(0);
            $table->decimal('total_gaji', 20, 2);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slip_gaji');
    }
};
