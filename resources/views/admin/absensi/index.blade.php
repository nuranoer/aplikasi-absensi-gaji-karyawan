@extends('layouts.templates.main')

@section('title', 'Data Absensi')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Posisi</th>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Persetujuan</th>
                                    <th class="text-center">Foto & Lokasi</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($riwayat as $a)
                                                                                                    <tr>
                                                                                                        <td class="text-center">{{ $a['karyawan']['nama'] ?? '-' }}</td>
                                                                                                        <td class="text-center">{{ $a['karyawan']['jabatan'] ?? '-' }}</td>
                                                                                                        <td class="text-center">{{ \Carbon\Carbon::parse($a['created_at'])->format('d M Y H:i:s') }}</td>
                                                                                                        <td class="text-center">{{ $a['status'] }}</td>
                                                                                                        <td class="text-center">
                                                                                                            @if ($a['persetujuan'] == 'approved')
                                                                                                                <span class="badge bg-success">Disetujui</span>
                                                                                                            @elseif ($a['persetujuan'] == 'pending')
                                                                                                                <span class="badge bg-warning">Pending</span>
                                                                                                            @else
                                                                                                                <span class="badge bg-danger">Ditolak</span>
                                                                                                            @endif
                                                                                                        </td>
                                                                                                        <td class="text-center">
                                                                                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalDetail">Lihat</button>
                                                                                                        </td>
                                                                                                        <td class="text-center">
                                                                                                            <div class="d-flex gap-2">
                                                                                                                @if ($a['persetujuan'] == 'pending')
                                                                                                                    <form action="{{ route('admin.absensi.approve', $a['id']) }}" method="POST"
                                                                                                                  >
                                                                                                                        @csrf
                                                                                                                        <button class="btn btn-success btn-sm">Approve</button>
                                                                                                                    </form>
                                                                                                                    <form action="{{ route('admin.absensi.reject', $a['id']) }}" method="POST"
                                                                                        >
                                                                                                                        @csrf
                                                                                                                        <button class="btn btn-danger btn-sm">Reject</button>
                                                                                                                    </form>
                                                                                                                @elseif ($a['persetujuan'] == 'approved')
                                                                                                                    <form action="{{ route('admin.absensi.reject', $a['id']) }}" method="POST"
                                                                                                                     >
                                                                                                                        @csrf
                                                                                                                        <button class="btn btn-danger btn-sm">Reject</button>
                                                                                                                    </form>
                                                                                                                @elseif ($a['persetujuan'] == 'rejected')
                                                                                                                    <form action="{{ route('admin.absensi.approve', $a['id']) }}" method="POST"
                                                                                                                  >
                                                                                                                        @csrf
                                                                                                                        <button class="btn btn-success btn-sm">Approve</button>
                                                                                                                    </form>
                                                                                                                @endif
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    @include('karyawan.riwayat.modal', [
                                        'modal_data' => $a
                                    ])
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Belum ada data absensi</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection