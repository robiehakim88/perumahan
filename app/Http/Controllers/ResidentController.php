<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\House;
use Illuminate\Http\Request;

class ResidentController extends Controller
{
    
  public function index(Request $request)
{
    // Ambil input pencarian
    $searchName = $request->input('search_name');
    $searchHouse = $request->input('search_house');

    // Query dasar dengan relasi house
    $query = Resident::with('house');

    // Filter berdasarkan nama
    if ($searchName) {
        $query->where('name', 'like', '%' . $searchName . '%');
    }

    // Filter berdasarkan nomor rumah
    if ($searchHouse) {
        $query->whereHas('house', function ($q) use ($searchHouse) {
            $q->where('house_number', 'like', '%' . $searchHouse . '%');
        });
    }

    // Pagination
   // $residents = $query->paginate(5);
    $residents = $query->with('house')
    ->orderBy('house_id')             // Urutkan berdasarkan nomor rumah
    ->orderBy('residents.date_of_birth', 'asc')   // Usia tertua = tanggal lahir lebih awal
    ->paginate(7);

    // Untuk statistik usia tetap sama seperti sebelumnya
        $ageGroups = [
        'Balita' => ['Laki-laki' => 0, 'Perempuan' => 0],
        'Anak-Anak' => ['Laki-laki' => 0, 'Perempuan' => 0],
        'Remaja' => ['Laki-laki' => 0, 'Perempuan' => 0],
        'Dewasa' => ['Laki-laki' => 0, 'Perempuan' => 0],
        'Lansia' => ['Laki-laki' => 0, 'Perempuan' => 0],
    ];
    
    $totalAll = ['Laki-laki' => 0, 'Perempuan' => 0];
    
    foreach (Resident::all() as $resident) {
        $age = $resident->age;
        $gender = $resident->gender;
    
        if ($age >= 0 && $age <= 5) {
            $ageGroups['Balita'][$gender]++;
        } elseif ($age >= 6 && $age <= 12) {
            $ageGroups['Anak-Anak'][$gender]++;
        } elseif ($age >= 13 && $age <= 18) {
            $ageGroups['Remaja'][$gender]++;
        } elseif ($age >= 19 && $age <= 59) {
            $ageGroups['Dewasa'][$gender]++;
        } else {
            $ageGroups['Lansia'][$gender]++;
        }
    
        // Tambah ke total keseluruhan
        $totalAll[$gender]++;
    }

   // return view('residents.index', compact('residents', 'ageGroups'));
    return view('residents.index', compact('residents', 'ageGroups', 'totalAll'));
}
    /**
     * Menampilkan form tambah penghuni untuk rumah tertentu.
     */
    public function create($houseId)
    {
        $house = House::findOrFail($houseId);
        return view('residents.create', compact('house'));
    }

    /**
     * Menyimpan data penghuni baru.
     */
    public function store(Request $request, $houseId)
    {
        $request->validate([
            'name' => 'required',
            'relationship' => 'required',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:Laki-laki,Perempuan', // Validasi jenis kelamin
        ]);

        $house = House::findOrFail($houseId);

        $house->residents()->create($request->all());

        return redirect()->route('houses.show', $houseId)->with('success', 'Data penghuni berhasil ditambahkan.');
    }

    /**
     * Menghapus data penghuni.
     */
    public function destroy($houseId, $residentId)
    {
        $resident = Resident::findOrFail($residentId);
        $resident->delete();

        return redirect()->route('houses.show', $houseId)->with('success', 'Data penghuni berhasil dihapus.');
    }
    
    /**
     * Menampilkan form edit penghuni.
     */
    public function edit($houseId, $residentId)
    {
        $house = House::findOrFail($houseId);
        $resident = Resident::findOrFail($residentId);

        return view('residents.edit', compact('house', 'resident'));
    }

    /**
     * Memperbarui data penghuni.
     */
    public function update(Request $request, $houseId, $residentId)
    {
        $request->validate([
            'name' => 'required',
            'relationship' => 'required',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:Laki-laki,Perempuan', // Validasi jenis kelamin
        ]);

        $resident = Resident::findOrFail($residentId);
        $resident->update($request->all());

        return redirect()->route('houses.show', $houseId)->with('success', 'Data penghuni berhasil diperbarui.');
    }
    
    public function selectHouse()
    {
        $houses = House::all(); // Ambil semua data rumah
        return view('residents.select-house', compact('houses'));
    }
}