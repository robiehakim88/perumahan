@extends('layouts.app')

@section('title', 'Data Penghuni')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Penghuni</h3>
            <div class="card-tools">
                <a href="{{ route('residents.create', ['houseId' => 0]) }}" class="btn btn-success btn-sm">
                    <i class="fas fa-plus"></i> Tambah Penghuni
                </a>
            </div>
        </div>
        <div class="card-body">
            @if ($residents->isEmpty())
                <p>Tidak ada data penghuni.</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Hubungan Keluarga</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Nomor Rumah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($residents as $resident)
                        <tr>
                            <td>{{ $resident->name }}</td>
                            <td>{{ $resident->relationship }}</td>
                            <td>{{ $resident->place_of_birth }}</td>
                            <td>{{ \Carbon\Carbon::parse($resident->date_of_birth)->format('d F Y') }}</td>
                            <td>{{ $resident->house->house_number ?? '-' }}</td>
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
        <div class="card-footer">
            {{ $residents->links() }} <!-- Paginasi -->
        </div>
    </div>
</div>
@endsection