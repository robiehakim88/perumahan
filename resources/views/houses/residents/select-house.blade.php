@extends('layouts.app')

@section('title', 'Pilih Rumah')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Pilih Rumah untuk Menambah Penghuni</h3>
        </div>
        <div class="card-body">
            @if ($houses->isEmpty())
                <p>Tidak ada data rumah.</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nomor Rumah</th>
                            <th>Nama Pemilik</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($houses as $house)
                        <tr>
                            <td>{{ $house->house_number }}</td>
                            <td>{{ $house->owner_name }}</td>
                            <td>{{ $house->statusLocalized }}</td>
                            <td>
                                <a href="{{ route('residents.create', $house->id) }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-plus"></i> Tambah Penghuni
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection