<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Hunian Rumah</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f4f4f4;
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Laporan Hunian Perumahan Taqiya Land RT 003 RW 004</h1>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nomor Rumah</th>
                <th>Nama Pemilik</th>
                <th>Status</th>
                <th>Jumlah Penghuni</th> <!-- Mengganti Jumlah Pengontrak -->
            </tr>
        </thead>
        <tbody>
            @forelse ($houses as $key => $house)
            <tr>
                <td>{{ $key + 1 }}</td>
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
                <td>{{ $house->residents_count }}</td> <!-- Menggunakan residents_count -->
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Tidak ada data rumah yang tersedia.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>