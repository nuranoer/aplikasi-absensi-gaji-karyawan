@extends('layouts.templates.main_karyawan')
@section('title', 'Slip Gaji')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">Periode</th>
                                    <th class="text-center">Gaji Pokok</th>
                                    <th class="text-center">Tunjangan</th>
                                    <th class="text-center">Potongan</th>
                                    <th class="text-center">Total Gaji</th>
                                    <th class="text-center">Hari Kerja</th>
                                    <th class="text-center">Izin</th>
                                    <th class="text-center">Sakit</th>
                                    <th class="text-center">Cuti</th>
                                    <th class="text-center">Keterangan</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $slip)
                                    <tr>
                                        <td class="text-center">
                                            {{ Carbon\Carbon::create()->month($slip->periode_bulan)->translatedFormat('F') . " {$slip->periode_tahun}" }}
                                        <td class="text-center">Rp{{ number_format($slip->gaji_pokok) }}</td>
                                        <td class="text-center">Rp{{ number_format($slip->tunjangan) }}</td>
                                        <td class="text-center">Rp{{ number_format($slip->potongan) }}</td>
                                        <td class="text-center">Rp{{ number_format($slip->total_gaji) }}</td>
                                        <td class="text-center">{{ $slip->hari_kerja ?? 0 }}</td>
                                        <td class="text-center">{{ $slip->izin ?? 0 }}</td>
                                        <td class="text-center">{{ $slip->sakit ?? 0 }}</td>
                                        <td class="text-center">{{ $slip->cuti ?? 0 }}</td>
                                        <td class="text-center">{{ $slip->keterangan ?? "(Tidak ada keterangan)" }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-sm btn-primary" target="_blank"
                                                href="<?= route('karyawan.slip.cetak', ['id' => $slip->id]) ?>">
                                                Cetak
                                            </a>
                                        </td>
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
@endsection

@push('scripts')
@endpush