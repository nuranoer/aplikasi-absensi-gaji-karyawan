@extends('layouts.templates.main_karyawan')

@section('title', 'Riwayat Kehadiran')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">Foto</th>
                                    <th class="text-center">Tipe</th>
                                    <th class="text-center">Persetujuan</th>
                                    <th class="text-center">Keterangan</th>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Lokasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($absensi as $a)
                                    <tr>
                                        <td class="text-center">
                                            @if ($a->foto)
                                                <a href="{{ $a->foto }}" target="_blank">
                                                    <img src="{{ $a->foto }}" alt="Foto" height="100">
                                                </a>
                                            @else
                                                Tidak ada foto
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($a->status == 'hadir')
                                            Hadir
                                            @elseif ($a->status == 'cuti')
                                            Cuti
                                            @elseif ($a->status == 'sakit')
                                            Sakit
                                            @elseif ($a->status == 'izin')
                                            Izin
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($a->approved == 'approved')
                                                <span class="badge bg-success">Disetujui</span>
                                            @elseif ($a->approved == 'pending')
                                                <span class="badge bg-warning">Pending</span>
                                            @else
                                                <span class="badge bg-danger">Ditolak</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <?= $a->keterangan ?? "(Tidak ada keterangan)" ?>
                                        </td>
                                        <td class="text-center">{{ \Carbon\Carbon::parse($a->tanggal)->format('d M Y') }}</td>
                                        <td class="text-center">
                                            @if ($a->lokasi)
                                                <a target="_blank" href="<?= "https://www.google.com/maps?q=$a->lokasi" ?>">Lihat</a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Belum ada data absensi.</td>
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