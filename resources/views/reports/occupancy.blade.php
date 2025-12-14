@extends('layouts.app')

@section('title', 'Laporan Hunian Rumah')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Laporan Hunian Rumah</h3>
            <!-- Tombol Cetak PDF (Opsional) -->
            <a href="{{ route('reports.occupancy.pdf') }}" class="btn btn-success" target="_blank">
                <i class="fas fa-download"></i> Unduh Laporan PDF
            </a>
        </div>
        <div class="card-body">
            <!-- Tabel Data Laporan Hunian -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nomor Rumah</th>
                        <th>Nama Pemilik</th>
                        <th>Status</th>
                        <th>Jumlah Penghuni</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($houses as $key => $house)
                    <tr>
                        <td>{{ $houses->firstItem() + $key }}</td>
                        <td>{{ $house->house_number }}</td>
                        <td>{{ $house->owner_name }}</td>
                        <td>
                            <!-- Mengubah status ke bahasa Indonesia -->
                            @if ($house->status === 'vacant')
                                Kosong
                            @elseif ($house->status === 'occupied')
                                Ditempati
                            @elseif ($house->status === 'rented')
                                Dikontrakkan
                            @else
                                Tidak Diketahui
                            @endif
                        </td>
                        <td>{{ $house->residents_count }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data rumah yang tersedia.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Paginasi -->
            <div class="d-flex justify-content-center">
                {{ $houses->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection