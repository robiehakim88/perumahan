@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Laporan Daftar Pengontrak</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Kepala Keluarga</th>
                <th>Rumah</th>
                <th>Tanggal Mulai Kontrak</th>
                <th>Tanggal Akhir Kontrak</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tenants as $tenant)
            <tr>
                <td>{{ $tenant->tenant_name }}</td>
                <td>{{ $tenant->house->owner_name }}</td>
                <td>{{ $tenant->start_date }}</td>
                <td>{{ $tenant->end_date }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection