@extends('layouts.app')

@section('title', 'Data Warga Aktif')

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title mb-0">Data Warga Aktif</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Penghuni Rumah</th>
                        <th>Nomor Rumah</th>
                        <th>Status Rumah</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($wargaAktif as $index => $warga)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $warga->nama_penghuni_rumah }}</td>
                        <td>{{ $warga->nomor_rumah }}</td>
                        <!--<td>{{ ucfirst($warga->status_rumah) }}</td>-->
                        <td>
                            <!-- Mengubah status ke bahasa Indonesia -->
                            @if ($warga->status_rumah === 'vacant')
                                Kosong
                            @elseif ($warga->status_rumah === 'occupied')
                                Ditempati
                            @elseif ($warga->status_rumah === 'rented')
                                Dikontrakkan
                            @else
                                Tidak Diketahui
                            @endif
                        </td>
                        
                        <td>
                            <form action="{{ route('warga-aktif.update-status', $warga->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" name="is_active" value="{{ $warga->is_active ? 0 : 1 }}" class="btn btn-sm {{ $warga->is_active ? 'btn-success' : 'btn-danger' }}">
                                    {{ $warga->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
             <!-- Paginasi -->
            <div class="d-flex justify-content-center">
                {{ $wargaAktif->appends(request()->query())->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection