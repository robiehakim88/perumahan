@extends('layouts.app')

@section('title', 'Laporan Pengontrak')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Laporan Pengontrak</h3>
            <!-- Tombol Cetak PDF (Opsional) -->
            <a href="{{ route('reports.tenants.pdf') }}" class="btn btn-success" target="_blank">
                <i class="fas fa-download"></i> Unduh Laporan PDF
            </a>
        </div>
        <div class="card-body">
            <!-- Tabel Data Laporan Pengontrak -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Pengontrak</th>
                        <th>Nama Pasangan</th>
                        <th>Tanggal Mulai Kontrak</th>
                        <th>Tanggal Akhir Kontrak</th>
                        <th>Nomor Rumah</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tenants as $key => $tenant)
                    <tr>
                        <td>{{ $tenants->firstItem() + $key }}</td>
                        <td>{{ $tenant->tenant_name }}</td>
                        <td>{{ $tenant->spouse_name ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($tenant->start_date)->format('d F Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($tenant->end_date)->format('d F Y') }}</td>
                        <td>{{ $tenant->house->house_number }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data pengontrak yang tersedia.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Paginasi -->
            <div class="d-flex justify-content-center">
                {{ $tenants->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection