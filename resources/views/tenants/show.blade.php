@extends('layouts.app')

@section('title', 'Detail Pengontrak')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Detail Pengontrak</h3>
        </div>
        <div class="card-body">
            <!-- Informasi Umum Pengontrak -->
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Nama Pengontrak:</strong> {{ $tenant->tenant_name }}</p>
                    <p><strong>Nama Pasangan:</strong> {{ $tenant->spouse_name ?? '-' }}</p>
                    <p><strong>Tanggal Mulai Kontrak:</strong> {{ \Carbon\Carbon::parse($tenant->start_date)->format('d F Y') }}</p>
                    <p><strong>Tanggal Akhir Kontrak:</strong> {{ \Carbon\Carbon::parse($tenant->end_date)->format('d F Y') }}</p>
                    <p><strong>Nomor Rumah:</strong> {{ $tenant->house_id }}</p>
                    <p><strong>Foto Pengontrak:</strong>
                    @if ($tenant->photo)
                            <img src="{{ asset('storage/' . $tenant->photo) }}" alt="Foto Pemilik" class="img-thumbnail" style="max-width: 200px;">
                        @else
                            Tidak ada foto.
                        @endif
                    </p>
                    
                    
                     
                </div>
               
            </div>

            <!-- Tombol Kembali -->
            <div class="mt-4">
                <a href="{{ route('tenants.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection