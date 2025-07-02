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
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karyawan_id')->constrained('karyawan');
            $table->date('tanggal');
            $table->enum('status', ['hadir', 'izin', 'sakit', 'cuti']);
            $table->enum('approved', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('keterangan')->nullable();

            // Kolom tambahan:
            $table->string('foto')->nullable();        // untuk path foto absensi
            $table->string('lokasi')->nullable();      // untuk koordinat lokasi (opsional)
            $table->text('user_agent')->nullable();    // untuk informasi perangkat (opsional)

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi');
    }
};
