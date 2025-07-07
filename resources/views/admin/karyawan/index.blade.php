@extends('layouts.templates.main')
@section('title', 'Data Karyawan')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                            <i class="fas fa-plus me-2"></i> Tambah Karyawan
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Jenis Kelamin</th>
                                    <th class="text-center">Jabatan</th>
                                    <th class="text-center">Alamat</th>
                                    <th class="text-center">Tanggal Dibuat</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($karyawan as $k)
                                    <tr>
                                        <td class="text-center">{{ $k->nama }}</td>
                                        <td class="text-center">{{ $k->email }}</td>
                                        <td class="text-center">{{ $k->jenis_kelamin }}</td>
                                        <td class="text-center">{{ $k->jabatan }}</td>
                                        <td class="text-center">{{ $k->alamat ?? "-" }}</td>
                                        <td class="text-center">{{ $k->created_at->format('d M Y') }}</td>
                                        <td class="text-center">
                                            <div class="d-flex gap-2">
                                                <button class="btn btn-sm btn-warning text-white" data-bs-toggle="modal"
                                                    data-bs-target="#modalEdit{{ $k->id }}"><i class="fas fa-edit"></i></button>
                                                <form action="{{ route('admin.karyawan.destroy', $k->id) }}" method="POST"
                                                    class="d-inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @include('admin.karyawan.modal', [
                                        'id' => 'modalEdit' . $k->id,
                                        'title' => 'Edit Karyawan',
                                        'route' => route('admin.karyawan.update', $k->id),
                                        'method' => 'PUT',
                                        'modal_data' => $k
                                    ])
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
    @include('admin.karyawan.modal')
@endsection