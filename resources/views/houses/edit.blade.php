@extends('layouts.app')

@section('title', 'Edit Rumah')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Rumah</h3>
        </div>
        <div class="card-body">
            <!-- Formulir Edit Rumah -->
            <form action="{{ route('houses.update', $house->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Nomor Rumah -->
                <div class="mb-3">
                    <label for="house_number" class="form-label">Nomor Rumah</label>
                    <input type="text" name="house_number" id="house_number" class="form-control" value="{{ old('house_number', $house->house_number) }}" required>
                    @error('house_number')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Nama Pemilik -->
                <div class="mb-3">
                    <label for="owner_name" class="form-label">Nama Pemilik</label>
                    <input type="text" name="owner_name" id="owner_name" class="form-control" value="{{ old('owner_name', $house->owner_name) }}" required>
                    @error('owner_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Nama Pasangan -->
                <div class="mb-3">
                    <label for="spouse_name" class="form-label">Nama Pasangan (Opsional)</label>
                    <input type="text" name="spouse_name" id="spouse_name" class="form-control" value="{{ old('spouse_name', $house->spouse_name) }}">
                    @error('spouse_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Status Rumah -->
                <div class="mb-3">
                    <label for="status" class="form-label">Status Rumah</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="vacant" {{ old('status', $house->status) === 'vacant' ? 'selected' : '' }}>Vacant (Kosong)</option>
                        <option value="occupied" {{ old('status', $house->status) === 'occupied' ? 'selected' : '' }}>Occupied (Ditempati)</option>
                        <option value="rented" {{ old('status', $house->status) === 'rented' ? 'selected' : '' }}>Rented (Disewa)</option>
                    </select>
                    @error('status')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

<!-- Foto Pemilik -->
<div class="mb-3">
    <label for="photo" class="form-label">Foto Pemilik (Opsional)</label>
    <input type="file" name="photo" id="photo" class="form-control">
    @if ($house->photo)
        <div class="mt-2">
            <p>Foto Saat Ini:</p>
            <img src="{{ asset('storage/' . $house->photo) }}" alt="Foto Pemilik" class="img-thumbnail" style="max-width: 200px;">
        </div>
    @endif
    @error('photo')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<!-- Foto Kartu Keluarga -->
<div class="mb-3">
    <label for="family_card_photo" class="form-label">Foto Kartu Keluarga (KK) (Opsional)</label>
    <input type="file" name="family_card_photo" id="family_card_photo" class="form-control">
    @if ($house->family_card_photo)
        <div class="mt-2">
            <p>Foto KK Saat Ini:</p>
            <img src="{{ asset('storage/' . $house->family_card_photo) }}" alt="Foto Kartu Keluarga" class="img-thumbnail" style="max-width: 200px;">
        </div>
    @endif
    @error('family_card_photo')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<!-- Foto Anggota Keluarga -->
<div class="mb-3">
    <label for="family_members_photos" class="form-label">Foto Anggota Keluarga (Opsional)</label>
    <input type="file" name="family_members_photos[]" id="family_members_photos" class="form-control" multiple>
    @if ($house->family_members_photos)
        <div class="mt-2">
            <p>Foto Anggota Keluarga Saat Ini:</p>
            <div class="row">
                @foreach (json_decode($house->family_members_photos) as $photo)
                    <div class="col-md-4 mb-3">
                        <img src="{{ asset('storage/' . $photo) }}" alt="Foto Anggota Keluarga" class="img-thumbnail" style="max-width: 150px;">
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    @error('family_members_photos')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

                <!-- Tombol Simpan dan Batal -->
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="{{ route('houses.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection