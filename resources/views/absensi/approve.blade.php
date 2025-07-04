@extends('layouts.templates.main')

@section('title', 'Kehadiran')

@section('content')
        <div class="container">
          <div class="page-inner">
            <div class="page-header">
              <h3 class="fw-bold mb-3">Kehadiran</h3>
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
                  <a href="/info">Kehadiran</a>
                </li>
              </ul>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Kehadiran</h4>
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
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th>Foto</th>
                                <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                        @forelse ($absensi as $a)
                            <tr>
                            <td>{{ $a->karyawan->nama ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($a->tanggal)->format('d M Y') }}</td>
                            <td><span class="badge bg-info">{{ ucfirst($a->status) }}</span></td>
                            <td>{{ $a->keterangan ?? '-' }}</td>
                            <td>
                                @if ($a->foto)
                                <a href="{{ asset('storage/' . $a->foto) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $a->foto) }}" width="60">
                                </a>
                                @else
                                Tidak ada foto
                                @endif
                            </td>
                            <td>
                                @if ($a->approved === null)
                                <form action="{{ route('absensi.approve', $a->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button class="btn btn-success btn-sm">Approve</button>
                                </form>
                                <form action="{{ route('absensi.reject', $a->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button class="btn btn-danger btn-sm">Reject</button>
                                </form>
                                @elseif($a->approved == 1)
                                <span class="badge bg-success">Disetujui</span>
                                @else
                                <span class="badge bg-danger">Ditolak</span>
                                @endif
                            </td>
                            </tr>
                        @empty
                            <tr>
                            <td colspan="6" class="text-center">Tidak ada pengajuan.</td>
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
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $("#basic-datatables").DataTable({});</script>
@endpush
