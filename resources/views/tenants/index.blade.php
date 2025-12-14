@extends('layouts.app')

@section('title', 'Data Pengontrak')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Daftar Pengontrak</h3>
            <!-- Tombol Tambah Data -->
            <a href="{{ route('tenants.create') }}" class="btn btn-primary">Tambah Pengontrak</a>
        </div>
        <div class="card-body">
            <!-- Form Pencarian -->
            <form action="{{ route('tenants.index') }}" method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan nama pengontrak..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </form>

            <!-- Tabel Data Pengontrak -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Pengontrak</th>
                        <th>Nama Pasangan</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Akhir</th>
                        <th>Nomor Rumah</th>
                        <th>Aksi</th>
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
                        <td>{{ $tenant->house_id }}</td>
                        <td>
                            <a href="{{ route('tenants.show', $tenant->id) }}" class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ route('tenants.edit', $tenant->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('tenants.destroy', $tenant->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data pengontrak yang ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Paginasi -->
            <div class="d-flex justify-content-center">
                {{ $tenants->appends(['search' => request('search')])->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection