@extends('layouts.templates.main_karyawan')

@section('title', 'Pengajuan Izin')

@section('content')
    @if ($available)
        <form id="form" action="<?= route('karyawan.absensi.pengajuan.store') ?>" method="post" enctype="multipart/form-data">
            @csrf

            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Upload Foto Bukti</label>
                            <input class="form-control" name="bukti" type="file" accept="image/png,.jpg,.jpeg" id="formFile"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Tipe Perizinan</label>
                            <select id="status" class="form-select" name="status" aria-label="Default select example" required>
                                <option value="izin" selected>Izin</option>
                                <option value="sakit">Sakit</option>
                                <option value="cuti">Cuti</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control" rows="5" name="keterangan" id="keterangan"
                                placeholder="Tulis keterangan..." required></textarea>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary" type="button" onclick="ajukan()">
                                Ajukan
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </form>
        <script>
            const form = document.getElementById('form');

            function ajukan() {
                if (!form.checkValidity()) {
                    form.reportValidity()
                    return;
                }
                Swal.fire({
                    icon: 'info',
                    title: "Konfirmasi",
                    text: 'Apakah anda yakin untuk mengajukan perizinan?',
                    confirmButtonText: "Ya",
                    cancelButtonText: "Tidak",
                    showCancelButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }
        </script>
    @else
        <div class="alert alert-success" role="alert">
            Anda telah melakukan absensi atau perizinan hari ini.
        </div>
    @endif
@endsection

@push('scripts')