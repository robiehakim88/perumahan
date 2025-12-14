<?php

namespace App\Http\Controllers;

use App\Models\House;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     

     
    public function index(Request $request)
{
    // Ambil kata kunci pencarian dari query string
    $search = $request->input('search');

    // Query data rumah dengan filter pencarian
    $query = House::query(); // Mulai query dasar

    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('house_number', 'like', '%' . $search . '%')
              ->orWhere('owner_name', 'like', '%' . $search . '%');
        });
    }

    // Paginasi hasil query
    $houses = $query->paginate(10);

    // Tetap menyertakan query string (search) di paginasi
    $houses->appends(['search' => $search]);

    return view('houses.index', compact('houses'));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
public function create()
{
    // Menampilkan halaman tambah data rumah
    return view('houses.create');
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
//public function store(Request $request)
//{
    // Validasi input
//    $validated = $request->validate([
//        'house_number' => 'required|unique:houses',
//        'owner_name' => 'required',
//        'spouse_name' => 'nullable',
//        'status' => 'required|in:vacant,occupied,rented',
//        'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Maksimal 2MB
//    ]);

    // Simpan data rumah
//    $house = House::create($validated);

    // Handle upload foto jika ada
//    if ($request->hasFile('photo')) {
//        $photoPath = $request->file('photo')->store('photos', 'public');
//        $house->update(['photo' => $photoPath]);
//    }

    // Redirect dengan pesan sukses
//    return redirect()->route('houses.index')->with('success', 'Data rumah berhasil ditambahkan.');
//}

public function store(Request $request)
{
    // Validasi input
    $validated = $request->validate([
        'house_number' => 'required|unique:houses',
        'owner_name' => 'required',
        'spouse_name' => 'nullable',
        'status' => 'required|in:vacant,occupied,rented',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Maksimal 2MB
        'family_card_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Foto KK
        'family_members_photos.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Foto anggota keluarga
    ]);

    // Simpan data rumah
    $house = House::create($validated);

    // Handle upload foto pemilik jika ada
    if ($request->hasFile('photo')) {
        $photoPath = $request->file('photo')->store('photos', 'public');
        $house->update(['photo' => $photoPath]);
    }

    // Handle upload foto KK jika ada
    if ($request->hasFile('family_card_photo')) {
        $familyCardPath = $request->file('family_card_photo')->store('family_cards', 'public');
        $house->update(['family_card_photo' => $familyCardPath]);
    }

    // Handle upload foto anggota keluarga jika ada
    if ($request->hasFile('family_members_photos')) {
        $familyMembersPhotos = [];
        foreach ($request->file('family_members_photos') as $file) {
            $familyMembersPhotos[] = $file->store('family_members', 'public');
        }
        $house->update(['family_members_photos' => json_encode($familyMembersPhotos)]);
    }

    // Redirect dengan pesan sukses
    return redirect()->route('houses.index')->with('success', 'Data rumah berhasil ditambahkan.');
}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     
     public function show(House $house)
    {
        return view('houses.show', compact('house'));
    }

    //public function show($id)
    //{
     //   return view('houses.show', compact('house'));
//    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function edit(House $house)
{
    // Menggunakan route model binding untuk mendapatkan data rumah berdasarkan ID
    return view('houses.edit', compact('house'));
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//public function update(Request $request, House $house)
//{
    // Validasi input
//    $validated = $request->validate([
//        'house_number' => 'required|unique:houses,house_number,' . $house->id,
//        'owner_name' => 'required',
//        'spouse_name' => 'nullable',
//        'status' => 'required|in:vacant,occupied,rented',
//        'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Maksimal 2MB
//    ]);

    // Update data rumah
//    $house->update($validated);

    // Handle upload foto jika ada
//    if ($request->hasFile('photo')) {
//        $photoPath = $request->file('photo')->store('photos', 'public');
//        $house->update(['photo' => $photoPath]);
//    }

    // Redirect dengan pesan sukses
//    return redirect()->route('houses.index')->with('success', 'Data rumah berhasil diperbarui.');
//}
public function update(Request $request, House $house)
{
    // Validasi input
    $validated = $request->validate([
        'house_number' => 'required|unique:houses,house_number,' . $house->id,
        'owner_name' => 'required',
        'spouse_name' => 'nullable',
        'status' => 'required|in:vacant,occupied,rented',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'family_card_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'family_members_photos.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Update data umum
    $house->update($validated);

    // Handle upload foto pemilik jika ada
    if ($request->hasFile('photo')) {
        $photoPath = $request->file('photo')->store('photos', 'public');
        $house->update(['photo' => $photoPath]);
    }

    // Handle upload foto KK jika ada
    if ($request->hasFile('family_card_photo')) {
        // Hapus foto KK lama jika ada
        if ($house->family_card_photo) {
            Storage::disk('public')->delete($house->family_card_photo);
        }
        // Simpan foto KK baru
        $familyCardPath = $request->file('family_card_photo')->store('family_card_photo', 'public');
        $house->family_card_photo = $familyCardPath; // Set nilai kolom
        $house->save(); // Simpan ke database
    }

    // Handle upload foto anggota keluarga jika ada
    if ($request->hasFile('family_members_photos')) {
        // Hapus foto anggota keluarga lama jika ada
        if ($house->family_members_photos) {
            foreach (json_decode($house->family_members_photos) as $oldPhoto) {
                Storage::disk('public')->delete($oldPhoto);
            }
        }
        // Simpan foto anggota keluarga baru
        $familyMembersPhotos = [];
        foreach ($request->file('family_members_photos') as $file) {
            $familyMembersPhotos[] = $file->store('family_members_photos', 'public');
        }
        $house->family_members_photos = json_encode($familyMembersPhotos); // Set nilai kolom
        $house->save(); // Simpan ke database
    }

    // Redirect dengan pesan sukses
    return redirect()->route('houses.index')->with('success', 'Data rumah berhasil diperbarui.');
}
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function destroy(House $house)
{
    // Hapus foto jika ada
    if ($house->photo) {
        Storage::disk('public')->delete($house->photo);
    }

    // Hapus data dari database
    $house->delete();

    // Redirect dengan pesan sukses
    return redirect()->route('houses.index')->with('success', 'Data rumah berhasil dihapus.');
}
}
