@extends('layouts.app')

@section('title', 'Daftar Warga')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Warga Perumahan Taqiya Land RT 003 RW 004</h3>
            <div class="card-tools">
                
            </div>
        </div>
        


        
        
        <!-- Form Pencarian -->
<div class="card mt-3">
    <div class="card-body">
        <form action="{{ route('residents.index') }}" method="GET">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="search_name" class="form-control" placeholder="Cari Nama Penghuni..." value="{{ request('search_name') }}">
                </div>
                <div class="col-md-4">
                    <input type="text" name="search_house" class="form-control" placeholder="Cari Nomor Rumah..." value="{{ request('search_house') }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary btn-block">Cari</button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('residents.index') }}" class="btn btn-secondary btn-block">Reset</a>
                </div>
            </div>
        </form>
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
                            <th>Jenis Kelamin</th>
                             <th>Usia</th>
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
                            <td>{{ \Carbon\Carbon::parse($resident->date_of_birth)->locale('id')->translatedFormat('d F Y') }}</td>
                            <td>{{ $resident->gender ?? '-' }}</td>
                            <td>{{ $resident->age }} tahun</td>
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
            {{ $residents->links('pagination::bootstrap-5') }} <!-- Paginasi -->
        </div>
        
        
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Statistik Pembagian Usia </h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kelompok Usia</th>
                    <th>Jumlah Laki-laki</th>
                    <th>Jumlah Perempuan</th>
                    <th>Total Penghuni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ageGroups as $group => $genders)
                <tr>
                    <td>{{ $group }}</td>
                    <td>{{ $genders['Laki-laki'] }}</td>
                    <td>{{ $genders['Perempuan'] }}</td>
                    <td>{{ $genders['Laki-laki'] + $genders['Perempuan'] }}</td>
                </tr>
                @endforeach
                <tr style="background-color: #f2f2f2; font-weight: bold;">
                    <td><strong>Total Semua</strong></td>
                    <td>{{ $totalAll['Laki-laki'] }}</td>
                    <td>{{ $totalAll['Perempuan'] }}</td>
                    <td>{{ $totalAll['Laki-laki'] + $totalAll['Perempuan'] }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<!-- Tambahkan Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div style="width: 600px; height: 300px;">
<canvas id="ageChart" width="600" height="300"></canvas>
<script>
    const ctx = document.getElementById('ageChart').getContext('2d');
    const ageChart = new Chart(ctx, {
        type: 'bar', // Jenis chart: bar
        data: {
            labels: {!! json_encode(array_keys($ageGroups)) !!}, // Label: kelompok usia
            datasets: [
                {
                    label: 'Laki-laki', // Dataset untuk laki-laki
                    data: {!! json_encode(array_column($ageGroups, 'Laki-laki')) !!}, // Data jumlah laki-laki
                    backgroundColor: 'rgba(54, 162, 235, 0.2)', // Warna background laki-laki
                    borderColor: 'rgba(54, 162, 235, 1)', // Warna border laki-laki
                    borderWidth: 1
                },
                {
                    label: 'Perempuan', // Dataset untuk perempuan
                    data: {!! json_encode(array_column($ageGroups, 'Perempuan')) !!}, // Data jumlah perempuan
                    backgroundColor: 'rgba(255, 99, 132, 0.2)', // Warna background perempuan
                    borderColor: 'rgba(255, 99, 132, 1)', // Warna border perempuan
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true, // Responsif terhadap ukuran layar
            scales: {
                y: {
                    beginAtZero: true, // Mulai dari nol di sumbu Y
                    ticks: {
                        stepSize: 1 // Interval antara nilai di sumbu Y
                    }
                }
            },
            plugins: {
                legend: {
                    display: true, // Tampilkan legenda
                    position: 'top' // Posisi legenda di atas chart
                },
                tooltip: {
                    enabled: true, // Aktifkan tooltip saat hover
                    callbacks: {
                        label: function (tooltipItem) {
                            return `${tooltipItem.dataset.label}: ${tooltipItem.raw}`;
                        }
                    }
                }
            }
        }
    });
</script>
</div>        
    </div>
</div>
@endsection