@extends('layouts.templates.main')

@section('title', 'Data Slip Gaji')

@section('content')
<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Data Slip Gaji</h3>
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
          <a href="/slip-gaji">Data Slip Gaji</a>
        </li>
      </ul>
    </div>

    <div class="row">
      <div class="col-md-12">

        <div class="mb-3 d-flex justify-content-end">
          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahSlip">
            + Tambah Slip Gaji
          </button>
        </div>

        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Slip Gaji Bulanan</h4>
          </div>

          <div class="card-body">
            <div class="table-responsive">
              <table id="basic-datatables" class="display table table-striped table-hover">
                <thead>
                  <tr>
                    <th>Nama</th>
                    <th>Periode</th>
                    <th>Hari Kerja</th>
                    <th>Izin</th>
                    <th>Sakit</th>
                    <th>Cuti</th>
                    <th>Gaji Pokok</th>
                    <th>Tunjangan</th>
                    <th>Potongan</th>
                    <th>Total Gaji</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($data as $slip)
                    <tr>
                      <td>{{ $slip->karyawan->nama ?? '-' }}</td>
                      <td>{{ \Carbon\Carbon::parse($slip->periode)->isoFormat('MMMM Y') }}</td>
                      <td>{{ $slip->hari_kerja }}</td>
                      <td>{{ $slip->izin }}</td>
                      <td>{{ $slip->sakit }}</td>
                      <td>{{ $slip->cuti }}</td>
                      <td>Rp{{ number_format($slip->gaji_pokok) }}</td>
                      <td>Rp{{ number_format($slip->tunjangan) }}</td>
                      <td>Rp{{ number_format($slip->potongan) }}</td>
                      <td>Rp{{ number_format($slip->total_gaji) }}</td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="10" class="text-center">Belum ada data slip gaji.</td>
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

<!-- MODAL TAMBAH -->
<div class="modal fade" id="modalTambahSlip" tabindex="-1" aria-labelledby="modalTambahSlipLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form action="{{ url('slip-gaji/simpan') }}" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTambahSlipLabel">Tambah Slip Gaji</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <label>Karyawan</label>
              <select name="karyawan_id" class="form-control" required>
                @foreach(App\Models\Karyawan::all() as $k)
                  <option value="{{ $k->id }}">{{ $k->nama }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-6">
              <label>Periode</label>
              <input type="date" name="periode" class="form-control" required>
            </div>
            <div class="col-md-4 mt-2">
              <label>Gaji Pokok</label>
              <input type="number" name="gaji_pokok" class="form-control" required>
            </div>
            <div class="col-md-4 mt-2">
              <label>Tunjangan</label>
              <input type="number" name="tunjangan" class="form-control">
            </div>
            <div class="col-md-4 mt-2">
              <label>Potongan</label>
              <input type="number" name="potongan" class="form-control">
            </div>
            <div class="col-md-12 mt-2">
              <label>Keterangan</label>
              <textarea name="keterangan" class="form-control" rows="2"></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Simpan</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
