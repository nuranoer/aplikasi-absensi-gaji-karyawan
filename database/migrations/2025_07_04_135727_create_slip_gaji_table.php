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
            $table->unsignedBigInteger('karyawan_id');
            $table->date('periode'); // misal: 2025-07-01
            $table->integer('hari_kerja')->nullable();
            $table->integer('izin')->nullable();
            $table->integer('sakit')->nullable();
            $table->integer('cuti')->nullable();
            $table->decimal('gaji_pokok', 12, 2);
            $table->decimal('tunjangan', 12, 2)->default(0);
            $table->decimal('potongan', 12, 2)->default(0);
            $table->decimal('total_gaji', 12, 2);
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('karyawan_id')->references('id')->on('tb_karyawan');
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
