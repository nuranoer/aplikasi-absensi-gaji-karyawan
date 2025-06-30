@extends('layouts.templates.main')

@section('title', 'Data Absensi')

@section('content')
<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Absensi</h3>
                    <p class="text-subtitle text-muted">Data Absensi PT. Soegitos</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Absensi</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Section start -->
        <section class="section">
            <div class="row" id="table-bordered">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Data Absensi</h4>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                        </div>
                    <form method="GET" class="row g-2 mb-3">
                        <div class="col-md-4">
                            <select name="status" class="form-select">
                                <option value="">-- Filter Status --</option>
                                @foreach(['hadir','izin','sakit','cuti'] as $opt)
                                    <option value="{{ $opt }}" {{ request('status') == $opt ? 'selected' : '' }}>{{ ucfirst($opt) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select name="approved" class="form-select">
                                <option value="">-- Filter Persetujuan --</option>
                                @foreach(['pending','approved','rejected'] as $opt)
                                    <option value="{{ $opt }}" {{ request('approved') == $opt ? 'selected' : '' }}>{{ ucfirst($opt) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-primary" type="submit">Filter</button>
                        </div>
                    </form>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Karyawan</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Persetujuan</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($absensi as $item)
                                    <tr>
                                        <td>{{ $item->karyawan->nama }}</td>
                                        <td>{{ $item->tanggal }}</td>
                                        <td>{{ ucfirst($item->status) }}</td>
                                        <td><span class="badge bg-{{ $item->approved == 'approved' ? 'success' : ($item->approved == 'rejected' ? 'danger' : 'warning') }}">{{ ucfirst($item->approved) }}</span></td>
                                        <td>{{ $item->keterangan ?? '-' }}</td>
                                        <td>
                                            @if($item->approved == 'pending')
                                                <form action="{{ route('absensi.approve', $item->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button class="btn btn-success btn-sm">Approve</button>
                                                </form>
                                                <form action="{{ route('absensi.reject', $item->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button class="btn btn-danger btn-sm">Reject</button>
                                                </form>
                                            @else
                                                <span class="text-muted">Sudah diproses</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6" class="text-center">Belum ada data absensi.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

