@extends('layouts.app')

@section('title', 'Tambah Rumah')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Rumah</h3>
        </div>
        <div class="card-body">
            <!-- Formulir Tambah Rumah -->
            <form action="{{ route('houses.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Nomor Rumah -->
                <div class="mb-3">
                    <label for="house_number" class="form-label">Nomor Rumah</label>
                    <input type="text" name="house_number" id="house_number" class="form-control" value="{{ old('house_number') }}" required>
                    @error('house_number')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Nama Pemilik -->
                <div class="mb-3">
                    <label for="owner_name" class="form-label">Nama Pemilik</label>
                    <input type="text" name="owner_name" id="owner_name" class="form-control" value="{{ old('owner_name') }}" required>
                    @error('owner_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Nama Pasangan -->
                <div class="mb-3">
                    <label for="spouse_name" class="form-label">Nama Pasangan (Opsional)</label>
                    <input type="text" name="spouse_name" id="spouse_name" class="form-control" value="{{ old('spouse_name') }}">
                    @error('spouse_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Status Rumah -->
                <div class="mb-3">
                    <label for="status" class="form-label">Status Rumah</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="vacant" {{ old('status') === 'vacant' ? 'selected' : '' }}>Vacant (Kosong)</option>
                        <option value="occupied" {{ old('status') === 'occupied' ? 'selected' : '' }}>Occupied (Ditempati)</option>
                        <option value="rented" {{ old('status') === 'rented' ? 'selected' : '' }}>Rented (Disewa)</option>
                    </select>
                    @error('status')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Foto Pemilik -->
                <div class="mb-3">
                    <label for="photo" class="form-label">Foto Pemilik (Opsional)</label>
                    <input type="file" name="photo" id="photo" class="form-control">
                    @error('photo')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Foto Kartu Keluarga -->
                <div class="mb-3">
                    <label for="family_card_photo" class="form-label">Foto Kartu Keluarga (Opsional)</label>
                    <input type="file" name="family_card_photo" id="family_card_photo" class="form-control">
                    @error('family_card_photo')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Foto Anggota Keluarga -->
                <div class="mb-3">
                    <label for="family_members_photos" class="form-label">Foto Anggota Keluarga (Opsional)</label>
                    <input type="file" name="family_members_photos[]" id="family_members_photos" class="form-control" multiple>
                    @error('family_members_photos')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tombol Simpan dan Batal -->
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('houses.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection