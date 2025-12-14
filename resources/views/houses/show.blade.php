@extends('layouts.app')

@section('title', 'Detail Rumah')

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title mb-0">Detail Rumah</h3>
        </div>
        <div class="card-body">
            <!-- Informasi Umum Rumah -->
            <div class="row">
                <div class="col-md-6">
                    <div class="d-flex flex-column gap-2">
                        <div class="d-flex justify-content-between">
                            <span class="fw-bold"><b>Nomor Rumah:</span>
                            <span>{{ $house->house_number }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="fw-bold">Nama Pemilik:</span>
                            <span>{{ $house->owner_name }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="fw-bold">Nama Pasangan:</span>
                            <span>{{ $house->spouse_name ?? '-' }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="fw-bold">Status:</span>
                            <span>
                                @if ($house->status === 'vacant')
                                    Kosong
                                @elseif ($house->status === 'occupied')
                                    Ditempati
                                @elseif ($house->status === 'rented')
                                    Dikontrakkan
                                @else
                                    Tidak Diketahui
                                @endif
                            </b></span>
                        </div>
                    </div>

                    <!-- Foto Pemilik -->
                    <div class="mt-4">
                        <p class="fw-bold mb-2">Foto Pemilik:</p>
                        <div class="d-flex justify-content-center">
                            @if ($house->photo)
                                <img src="{{ asset('storage/' . $house->photo) }}" alt="Foto Pemilik" class="img-thumbnail rounded" style="max-width: 200px; max-height: 200px;">
                            @else
                                <p class="text-muted">Tidak ada foto.</p>
                            @endif
                        </div>
                    </div>

<!-- Foto Kartu Keluarga -->
@if ($house->family_card_photo)
    <div class="mt-4">
        <p class="fw-bold mb-2">Foto Kartu Keluarga (KK):</p>
        <div class="d-flex justify-content-center">
            <?php
            $watermarkedPhoto = \App\Helpers\ImageHelper::addWatermark($house->family_card_photo);
            ?>
            @if ($watermarkedPhoto)
                <img src="{{ $watermarkedPhoto }}" alt="Foto Kartu Keluarga" class="img-thumbnail rounded" style="max-width: 300px; max-height: 300px;">
            @else
                <p class="text-muted">Tidak ada foto Kartu Keluarga.</p>
            @endif
        </div>
    </div>
@endif
                </div>
            </div>

            <!-- Data Pengontrak -->
            <div class="mt-4">
                <h5 class="text-primary">Data Pengontrak</h5>
                <hr class="my-2">
                @if ($house->tenants->isEmpty())
                    <p class="text-muted">Tidak ada pengontrak untuk rumah ini.</p>
                @else
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Nama Pengontrak</th>
                                <th>Nama Pasangan</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Akhir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($house->tenants as $tenant)
                            <tr>
                                <td>{{ $tenant->tenant_name }}</td>
                                <td>{{ $tenant->spouse_name ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($tenant->start_date)->format('d F Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($tenant->end_date)->format('d F Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

            <!-- Data Penghuni -->
            <div class="mt-4">
                <h5 class="text-primary">Data Penghuni</h5>
                <hr class="my-2">
                @if ($house->residents->isEmpty())
                    <p class="text-muted">Tidak ada penghuni untuk rumah ini.</p>
                @else
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Nama</th>
                                <th>Hubungan Keluarga</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Usia</th>
                                <th><a href="{{ route('residents.create', $house->id) }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-plus"></i> Tambah Penghuni
                                </a></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($house->residents as $resident)
                            <tr>
                                <td>{{ $resident->name }}</td>
                                <td>{{ $resident->relationship }}</td>
                                <td>{{ $resident->place_of_birth }}</td>
                                <td>{{ \Carbon\Carbon::parse($resident->date_of_birth)->locale('id')->translatedFormat('d F Y') }}</td>
                                <td>{{ $resident->gender ?? '-' }}</td>
                                <td>{{ $resident->age }} tahun</td>
                               
                                 <td>
                                <a href="{{ route('residents.edit', [$resident->house_id, $resident->id]) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('residents.destroy', [$resident->house_id, $resident->id]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus penghuni ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

<!-- Foto Anggota Keluarga -->
@if ($house->family_members_photos)
    <div class="mt-4">
        <p class="fw-bold mb-2">Foto Anggota Keluarga:</p>
        <div class="row">
            @foreach (json_decode($house->family_members_photos) as $photo)
                <div class="col-md-4 mb-3">
                    <?php
                    $watermarkedPhoto = \App\Helpers\ImageHelper::addWatermark($photo);
                    ?>
                    @if ($watermarkedPhoto)
                        <img src="{{ $watermarkedPhoto }}" alt="Foto Anggota Keluarga" class="img-thumbnail rounded" style="max-width: 100%; height: auto;">
                    @else
                        <p class="text-muted">Foto tidak tersedia.</p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endif

            <!-- Tombol Kembali -->
            <div class="mt-4">
                <a href="{{ route('houses.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection