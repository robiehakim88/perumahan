@extends('layouts.app')

@section('title', 'Edit Penghuni')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Edit Penghuni untuk Rumah Nomor {{ $house->house_number }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('residents.update', [$house->id, $resident->id]) }}" method="POST">
                @csrf
                @method('PUT') <!-- Metode HTTP PUT untuk pembaruan -->

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Penghuni</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $resident->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="relationship" class="form-label">Hubungan Keluarga</label>
                    <input type="text" name="relationship" id="relationship" class="form-control" value="{{ old('relationship', $resident->relationship) }}" required>
                </div>

                <div class="mb-3">
                    <label for="place_of_birth" class="form-label">Tempat Lahir</label>
                    <input type="text" name="place_of_birth" id="place_of_birth" class="form-control" value="{{ old('place_of_birth', $resident->place_of_birth) }}" required>
                </div>

                <div class="mb-3">
                    <label for="date_of_birth" class="form-label">Tanggal Lahir</label>
                    <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" value="{{ old('date_of_birth', $resident->date_of_birth) }}" required>
                </div>
                <div class="mb-3">
                    <label for="gender" class="form-label">Jenis Kelamin</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="gender" id="male" value="Laki-laki" class="form-check-input"
                                {{ old('gender', $resident->gender) == 'Laki-laki' ? 'checked' : '' }} required>
                            <label for="male" class="form-check-label">Laki-laki</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="gender" id="female" value="Perempuan" class="form-check-input"
                                {{ old('gender', $resident->gender) == 'Perempuan' ? 'checked' : '' }} required>
                            <label for="female" class="form-check-label">Perempuan</label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('houses.show', $house->id) }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection