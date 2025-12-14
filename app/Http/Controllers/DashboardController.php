<?php


namespace App\Http\Controllers;

use App\Models\House;
use App\Models\Tenant;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung total rumah
        $houseCount = House::count();
        // return view('dashboard', compact('houseCount'));

        // Hitung total pengontrak
        $tenantCount = Tenant::count();

        // Hitung rumah yang ditempati
        $occupiedCount = House::where('status', 'occupied')->count();

        // Hitung rumah yang kosong
        $vacantCount = House::where('status', 'vacant')->count();

        // Kirim data ke view
        return view('dashboard', compact('houseCount', 'tenantCount', 'occupiedCount', 'vacantCount'));
      
    }
}