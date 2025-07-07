@extends('layouts.templates.main_karyawan')

@section('title', 'Riwayat Absensi')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Jenis</th>
                                    <th class="text-center">Keterangan</th>
                                    <th class="text-center">Persetujuan</th>
                                    <th class="text-center">Bukti</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($absensi as $a)
                                    <tr>
                                        <td class="text-center">{{ \Carbon\Carbon::parse($a->tanggal)->format('d M Y H:i:s') }}</td>
                                        <td class="text-center">{{ $a->jenis }}</td>
                                        <td class="text-center">{{ $a->keterangan }}</td>
                                        <td class="text-center">
                                            @if ($a->persetujuan == 'approved')
                                                <span class="badge bg-success">Disetujui</span>
                                            @elseif ($a->persetujuan == 'pending')
                                                <span class="badge bg-warning">Pending</span>
                                            @else
                                                <span class="badge bg-danger">Ditolak</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($a->bukti)
                                                <a href="{{ $a->bukti }}" target="_blank">
                                                    <img src="{{ $a->bukti }}" alt="Foto" height="100">
                                                </a>
                                            @else
                                                Tidak ada foto
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada data absensi.</td>
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

@push('scripts')