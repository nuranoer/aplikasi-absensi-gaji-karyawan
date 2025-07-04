@extends('layouts.templates.main')

@section('title', 'Data Karyawan')

@section('content')
        <div class="container">
          <div class="page-inner">
            <div class="page-header">
              <h3 class="fw-bold mb-3">Data Karyawan</h3>
              <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                  <a href="/">
                    <i class="icon-home"></i>
                  </a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="/karyawan">Data Karyawan</a>
                </li>
              </ul>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Data Karyawan</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table
                        id="basic-datatables"
                        class="display table table-striped table-hover"
                      >
                        <thead>
                          <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Jenis Kelamin</th>
                                <th>Jabatan</th>
                                <th>Alamat</th>
                                <th>Tanggal Dibuat</th>
                                <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                                @forelse ($karyawan as $k)
                                        <tr>
                                            <td>{{ $k->nama }}</td>
                                            <td>{{ $k->email }}</td>
                                            <td>{{ $k->jenis_kelamin }}</td>
                                            <td>{{ $k->jabatan }}</td>
                                            <td>{{ $k->alamat }}</td>
                                            <td>{{ $k->created_at->format('d M Y') }}</td>
                                            <td>
                                                <button class="btn btn-warning edit-btn" 
                                                    data-id="{{ $k->id }}"
                                                    data-nama="{{ $k->nama }}"
                                                    data-email="{{ $k->email }}"
                                                    data-jenis_kelamin="{{ $k->jenis_kelamin }}"
                                                    data-jabatan="{{ $k->jabatan }}"
                                                    data-alamat="{{ $k->alamat }}">
                                                    Edit
                                                    </button>


                                                <form action="{{ route('karyawan.destroy', $k->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Yakin hapus data ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Belum ada data karyawan.</td>
                                        </tr>
                                    @endforelse                        
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('karyawan.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahLabel">Tambah Karyawan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body row g-3">
                <div class="col-md-6">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control" required>
                        <option value="">Pilih</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Jabatan</label>
                    <input type="text" name="jabatan" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="POST" id="formEdit" class="modal-content">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditLabel">Edit Karyawan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body row g-3">
                <div class="col-md-6">
                    <label>Nama</label>
                    <input type="text" name="nama" id="edit-nama" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label>Email</label>
                    <input type="email" name="email" id="edit-email" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="edit-jenis_kelamin" class="form-control" required>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Jabatan</label>
                    <input type="text" name="jabatan" id="edit-jabatan" class="form-control" required>
                </div>
                <div class="col-md-12">
                    <label>Alamat</label>
                    <textarea name="alamat" id="edit-alamat" class="form-control"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function () {
        $("#basic-datatables").DataTable({});</script>
@endpush
