<div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailLabel">
                    Detail Absensi
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body row g-3">
                <!-- Absen Masuk -->
                <div class="col-md-6">
                    <div class="card shadow-none h-auto">
                        <div class="card-header text-center fw-bold">
                            Absen Masuk
                        </div>
                        <div class="card-body">
                            <img id="fotoMasuk" src="{{ $a['foto_masuk'] }}" alt="Foto Absen Masuk"
                                class="img-fluid rounded border mb-3" style="max-height: 300px; object-fit: cover;">
                            <a class="btn btn-primary w-100"
                                href="https://www.google.com/maps?q={{ $a['lokasi_masuk'] }}">Lihat Lokasi</a>
                        </div>
                    </div>
                </div>
                <!-- Absen Pulang -->
                <div class="col-md-6">
                    <div class="card shadow-none h-auto">
                        <div class="card-header text-center fw-bold">
                            Absen Pulang
                        </div>
                        <div class="card-body">
                            @if ($a['foto_pulang'])
                                <img id="fotoPulang" src="{{ $a['foto_pulang'] }}" alt="Foto Absen Pulang"
                                    class="img-fluid rounded border mb-3" style="max-height: 300px; object-fit: cover;">
                                <a class="btn btn-primary w-100"
                                    href="https://www.google.com/maps?q={{ $a['lokasi_masuk'] }}">Lihat Lokasi</a>
                            @else
                                <p class="text-center text-muted">Belum ada foto absen pulang.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>