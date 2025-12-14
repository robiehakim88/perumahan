<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    /**
     * Menampilkan laporan hunian rumah.
     */
  //  public function occupancy()
    //{
        // Ambil data rumah dengan jumlah pengontrak menggunakan eager loading dan count relasi
     //   $houses = House::withCount('tenants')->paginate(10);

//        return view('reports.occupancy', compact('houses'));
 //   }
    
    public function occupancy()
    {
        // Ambil data rumah dengan jumlah penghuni menggunakan eager loading dan count relasi
        $houses = House::withCount('residents')->paginate(10);
    
        return view('reports.occupancy', compact('houses'));
    }
        
    
//    public function occupancyPdf()
//    {
        // Ambil semua data rumah dengan jumlah pengontrak
//        $houses = House::withCount('tenants')->get();

        // Generate PDF
//        $pdf = Pdf::loadView('reports.occupancy-pdf', compact('houses'));

        // Unduh file PDF
//        return $pdf->download('laporan-hunian-rumah.pdf');
//    }


public function occupancyPdf()
{
    // Ambil semua data rumah dengan jumlah penghuni
    $houses = House::withCount('residents')->get();

    // Generate PDF
    $pdf = Pdf::loadView('reports.occupancy-pdf', compact('houses'));

    // Unduh file PDF
    return $pdf->download('laporan-hunian-rumah.pdf');
}
    
   public function tenants()
{
    // Ambil data pengontrak dengan eager loading relasi house
    $tenants = Tenant::with('house')->paginate(10);

    return view('reports.tenants', compact('tenants'));
}

public function tenantsPdf()
{
    // Ambil semua data pengontrak dengan eager loading relasi house
    $tenants = Tenant::with('house')->get();

    // Generate PDF
    $pdf = Pdf::loadView('reports.tenants-pdf', compact('tenants'));

    // Unduh file PDF
    return $pdf->download('laporan-pengontrak.pdf');
}
}
