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
                    <h3>Slip Gaji</h3>
                    <p class="text-subtitle text-muted">Data Slip Gaji PT. Soegitos</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Slip Gaji</li>
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
                            <h4 class="card-title">Data Slip Gaji</h4>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                        </div>


                    <div class="table-responsive">
                        <table class="table table-striped" id="slip-table">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Periode</th>
                                    <th>Gaji Pokok</th>
                                    <th>Tunjangan</th>
                                    <th>Potongan</th>
                                    <th>Total Gaji</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($slipGaji as $slip)
                                <tr>
                                    <td>{{ $slip->karyawan->nama }}</td>
                                    <td>{{ \Carbon\Carbon::parse($slip->periode)->format('F Y') }}</td>
                                    <td>Rp{{ number_format($slip->gaji_pokok, 0, ',', '.') }}</td>
                                    <td>Rp{{ number_format($slip->tunjangan, 0, ',', '.') }}</td>
                                    <td>Rp{{ number_format($slip->potongan, 0, ',', '.') }}</td>
                                    <td><strong>Rp{{ number_format($slip->total_gaji, 0, ',', '.') }}</strong></td>
                                    <td>
                                        @if ($slip->status == 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @else
                                            <span class="badge bg-success">Approved</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($slip->status == 'pending')
                                            <form action="{{ route('slip-gaji.approve', $slip->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('PATCH')
                                                <button class="btn btn-sm btn-success" onclick="return confirm('Approve slip ini?')">
                                                    <i class="bi bi-check-circle"></i> Approve
                                                </button>
                                            </form>
                                        @endif
                                        <a href="{{ route('slip-gaji.export', $slip->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-file-earmark-pdf"></i> PDF
                                        </a>
                                    </td>
                                </tr>
                                @endforeach

                                @if ($slipGaji->isEmpty())
                                <tr>
                                    <td colspan="8" class="text-center">Belum ada data slip gaji.</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>       </div>
                </div>
            </div>
        </section>
    </div>
</div>

