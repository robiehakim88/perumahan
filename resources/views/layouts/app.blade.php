<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- CSS AdminLTE -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Source Sans Pro', sans-serif;
        }
    </style>
    
    <!-- SweetAlert CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="hold-transition sidebar-mini">
    <!-- Inisialisasi PushMenu -->
<script>
    $(document).ready(function () {
        // Inisialisasi PushMenu untuk toggle sidebar
        $('[data-widget="pushmenu"]').PushMenu();
    });
</script>
    <div class="wrapper">
        
        
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>

        <!-- Sidebar -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="{{ route('dashboard') }}" class="brand-link">
                <span class="brand-text font-weight-light">Perumahan App</span>
            </a>
            <div class="sidebar">
                <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('houses.index') }}" class="nav-link {{ request()->is('houses*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Data Rumah</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('tenants.index') }}" class="nav-link {{ request()->is('tenants*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Data Pengontrak</p>
                        </a>
                    </li>
                    <!-- Tambahkan Menu Data Penghuni -->
                    <li class="nav-item">
                        <a href="{{ route('residents.index') }}" class="nav-link {{ request()->is('residents*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-friends"></i>
                            <p>Data Penghuni</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('warga-aktif.index') }}" class="nav-link {{ request()->is('warga-aktif*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-check-circle"></i>
                            <p>Data Warga Aktif</p>
                        </a>
                    </li>
                    <li class="nav-item menu-open">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-chart-bar"></i>
                            <p>
                                Laporan
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('reports.occupancy') }}" class="nav-link {{ request()->is('reports/occupancy') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Status Hunian</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('reports.tenants') }}" class="nav-link {{ request()->is('reports/tenants') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pengontrak</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                </nav>
            </div>
        </aside>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield('title')</h1>
                        </div>
                    </div>
                </div>
            </div>
            <section class="content">
                
       <!-- SweetAlert Script -->
        <script>
            // Menampilkan pop-up jika ada pesan sukses dari session
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    timer: 3000, // Otomatis hilang setelah 3 detik
                    showConfirmButton: false,
                });
            @endif

            // Menampilkan pop-up jika ada pesan error dari session
            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: "{{ session('error') }}",
                    timer: 3000, // Otomatis hilang setelah 3 detik
                    showConfirmButton: false,
                });
            @endif
        </script>
        <!-- Konten Halaman -->
     
                <div class="container-fluid">
                    @yield('content')
                </div>
                 </div>
            </section>
        </div>

        <!-- Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; {{ date('Y') }} <a href="#">Perumahan App</a>.</strong>
            All rights reserved.
        </footer>
    </div>

    <!-- JS AdminLTE -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    
    <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- JS AdminLTE -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>