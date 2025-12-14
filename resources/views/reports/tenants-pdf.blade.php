<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengontrak</title>
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
    <h1>Laporan Pengontrak</h1>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Pengontrak</th>
                <th>Nama Pasangan</th>
                <th>Tanggal Mulai Kontrak</th>
                <th>Tanggal Akhir Kontrak</th>
                <th>Nomor Rumah</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tenants as $key => $tenant)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $tenant->tenant_name }}</td>
                <td>{{ $tenant->spouse_name ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($tenant->start_date)->format('d F Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($tenant->end_date)->format('d F Y') }}</td>
                <td>{{ $tenant->house->house_number }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Tidak ada data pengontrak yang tersedia.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>