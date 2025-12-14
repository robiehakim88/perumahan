<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HouseController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\WargaAktifController;


Route::get('/', function () {
    return view('auth.login');
});




Route::middleware(['auth'])->group(function () {
    
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Resource routes untuk Data Rumah
    Route::resource('houses', HouseController::class);
   // Route::get('/houses', [HouseController::class, 'index'])->name('houses.index');


    // Resource routes untuk Data Pengontrak
    Route::resource('tenants', TenantController::class);

    // Laporan
     // Halaman laporan hunian
     Route::get('/reports/occupancy', [ReportController::class, 'occupancy'])->name('reports.occupancy');
    
    // Export laporan PDF
    Route::get('/reports/occupancy/pdf', [ReportController::class, 'occupancyPdf'])->name('reports.occupancy.pdf');

     // Laporan pengontrak
    Route::get('/reports/tenants', [ReportController::class, 'tenants'])->name('reports.tenants');

    // Export laporan pengontrak PDF
    Route::get('/reports/tenants/pdf', [ReportController::class, 'tenantsPdf'])->name('reports.tenants.pdf');

    Route::delete('/tenants/{tenant}/remove-photo/{index}', [TenantController::class, 'removePhoto'])->name('tenants.remove.photo');
    
    Route::prefix('reports')->group(function () {
        Route::get('/occupancy', [ReportController::class, 'occupancy'])->name('reports.occupancy');
        Route::get('/tenants', [ReportController::class, 'tenants'])->name('reports.tenants');
    });
    
    
    Route::get('/houses/{houseId}/residents/create', [ResidentController::class, 'create'])->name('residents.create');
    Route::post('/houses/{houseId}/residents', [ResidentController::class, 'store'])->name('residents.store');
    Route::delete('/houses/{houseId}/residents/{residentId}', [ResidentController::class, 'destroy'])->name('residents.destroy');
    Route::get('/houses/{houseId}/residents/{residentId}/edit', [ResidentController::class, 'edit'])->name('residents.edit');
    Route::put('/houses/{houseId}/residents/{residentId}', [ResidentController::class, 'update'])->name('residents.update');
    });
    
    Route::get('/residents', [ResidentController::class, 'index'])->name('residents.index');
    Route::get('/residents/select-house', [ResidentController::class, 'selectHouse'])->name('residents.select-house');
    
// Route untuk Data Warga Aktif
    Route::get('/warga-aktif', [WargaAktifController::class, 'index'])->name('warga-aktif.index');
    Route::put('/warga-aktif/{id}/update-status', [WargaAktifController::class, 'updateStatus'])->name('warga-aktif.update-status');
    
    
    

// Admin-specific routes (if needed)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
      Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
