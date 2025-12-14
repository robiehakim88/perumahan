<!-- Data Penghuni -->
<div class="mt-4">
    <h5>Data Penghuni</h5>
    @if ($house->residents->isEmpty())
        <p>Tidak ada penghuni untuk rumah ini.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Hubungan Keluarga</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($house->residents as $resident)
                <tr>
                    <td>{{ $resident->name }}</td>
                    <td>{{ $resident->relationship }}</td>
                    <td>{{ $resident->place_of_birth }}</td>
                    <td>{{ \Carbon\Carbon::parse($resident->date_of_birth)->format('d F Y') }}</td>
                    <td>
                        <a href="{{ route('residents.edit', [$house->id, $resident->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('residents.destroy', [$house->id, $resident->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus penghuni ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    <a href="{{ route('residents.create', $house->id) }}" class="btn btn-success mt-3">Tambah Penghuni</a>
</div>