@extends('layouts.app')

@section('title', 'Data Rumah')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Daftar Rumah</h3>
            <!-- Tombol Tambah Data -->
            <a href="{{ route('houses.create') }}" class="btn btn-primary">Tambah Rumah</a>
        </div>
        <div class="card-body">
            <!-- Form Pencarian -->
            <form action="{{ route('houses.index') }}" method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan nomor rumah atau nama pemilik..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </form>

            <!-- Tabel Data Rumah -->
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nomor Rumah</th>
                        <th>Nama Pemilik</th>
                        <th>Status</th>
                        <th>Aksi</th>
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
                        <td>
                            <a href="{{ route('residents.create', $house->id) }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-plus"></i> Tambah Penghuni
                                </a>
                            <a href="{{ route('houses.show', $house->id) }}" class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ route('houses.edit', $house->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('houses.destroy', $house->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data rumah yang ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Paginasi -->
            <div class="d-flex justify-content-center">
                {{ $houses->appends(['search' => request('search')])->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
@endsection