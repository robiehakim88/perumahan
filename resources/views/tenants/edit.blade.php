@extends('layouts.app')

@section('title', 'Edit Pengontrak')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Pengontrak</h3>
        </div>
        <div class="card-body">
            <!-- Formulir Edit Pengontrak -->
            <form action="{{ route('tenants.update', $tenant->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Nama Pengontrak -->
                <div class="mb-3">
                    <label for="tenant_name" class="form-label">Nama Pengontrak</label>
                    <input type="text" name="tenant_name" id="tenant_name" class="form-control" value="{{ old('tenant_name', $tenant->tenant_name) }}" required>
                    @error('tenant_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Nama Pasangan -->
                <div class="mb-3">
                    <label for="spouse_name" class="form-label">Nama Pasangan (Opsional)</label>
                    <input type="text" name="spouse_name" id="spouse_name" class="form-control" value="{{ old('spouse_name', $tenant->spouse_name) }}">
                    @error('spouse_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tanggal Mulai Kontrak -->
                <div class="mb-3">
                    <label for="start_date" class="form-label">Tanggal Mulai Kontrak</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date', $tenant->start_date) }}" required>
                    @error('start_date')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tanggal Akhir Kontrak -->
                <div class="mb-3">
                    <label for="end_date" class="form-label">Tanggal Akhir Kontrak</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date', $tenant->end_date) }}" required>
                    @error('end_date')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Nomor Rumah -->
                <div class="mb-3">
                    <label for="house_id" class="form-label">Nomor Rumah</label>
                    <select name="house_id" id="house_id" class="form-select" required>
                        <option value="" disabled>Pilih Nomor Rumah</option>
                        @foreach ($houses as $house)
                            <option value="{{ $house->id }}" {{ old('house_id', $tenant->house_id) == $house->id ? 'selected' : '' }}>
                                {{ $house->house_number }}
                            </option>
                        @endforeach
                    </select>
                    @error('house_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>


                
                <!-- Foto Pemilik -->
                <div class="mb-3">
                    <label for="photo" class="form-label">Foto Pengontrak (Opsional)</label>
                    <input type="file" name="photo" id="photo" class="form-control">
                    @if ($tenant->photo)
                        <div class="mt-2">
                            <p>Foto Saat Ini:</p>
                            <img src="{{ asset('storage/' . $tenant->photo) }}" alt="Foto Pengontrak" class="img-thumbnail" style="max-width: 200px;">
                        </div>
                    @endif
                    @error('photo')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>                

               

                <!-- Tombol Simpan dan Batal -->
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="{{ route('tenants.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection