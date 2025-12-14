<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenant;

class TenantController extends Controller
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

    // Query data pengontrak dengan filter pencarian
   // $query = Tenant::with('house'); // Eager loading relasi house
    $query = Tenant::query();
       
       
    if ($search) {
        $query->where(function ($q) use ($search) {
        $q->where('tenant_name', 'like', '%' . $search . '%')
          ->orWhere('house_id', 'like', '%' . $search . '%');
    });
    }

    // Paginasi hasil query
    $tenants = $query->paginate(10);

    // Tetap menyertakan query string (search) di paginasi
    $tenants->appends(['search' => $search]);
    return view('tenants.index', compact('tenants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
public function create()
{
    // Ambil semua data rumah untuk dropdown
    $houses = \App\Models\House::all();
    return view('tenants.create', compact('houses'));
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     
     
     
     
     
     
     
     
     
     
     
     
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'tenant_name' => 'required',
            'spouse_name' => 'nullable',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'house_id' => 'required|exists:houses,id',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Maksimal 2MB per foto
        ]);
    
        // Simpan data pengontrak
        $tenant = Tenant::create($validated);
    
 // Handle upload foto jika ada
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
            $tenant->update(['photo' => $photoPath]);
        }
    
    // Handle upload foto jika ada
  //  if ($request->hasFile('photos')) {
    //    foreach ($request->file('photos') as $photo) {
    //        $photoPath = $photo->store('photos', 'public');
    //        // Simpan path foto ke database, misalnya dalam array atau string
    //        // Anda mungkin perlu menyesuaikan ini sesuai dengan struktur database Anda
    //        $tenant->photos()->create(['path' => $photoPath]);
    //    }
    //}
    
        return redirect()->route('tenants.index')->with('success', 'Data pengontrak berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tenant $tenant)
    {
        return view('tenants.show', compact('tenant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function edit(Tenant $tenant)
{
    // Ambil semua data rumah untuk dropdown
    $houses = \App\Models\House::all();
    return view('tenants.edit', compact('tenant', 'houses'));
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tenant $tenant)
    {
        // Validasi input
        $validated = $request->validate([
            'tenant_name' => 'required',
            'spouse_name' => 'nullable',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'house_id' => 'required|exists:houses,id',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Maksimal 2MB per foto
        ]);
    
        // Update data pengontrak
        $tenant->update($validated);
    
       // Handle upload foto jika ada
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
            $tenant->update(['photo' => $photoPath]);
        }
        
        
        
        // Handle upload foto jika ada
        //if ($request->hasFile('photos')) {
        //    foreach ($request->file('photos') as $photo) {
        //        $photoPath = $photo->store('photos', 'public');
        //        // Simpan path foto ke database, misalnya dalam array atau string
        //        // Anda mungkin perlu menyesuaikan ini sesuai dengan struktur database Anda
        //        $tenant->photos()->create(['path' => $photoPath]);
        //    }
        //}

            return redirect()->route('tenants.index')->with('success', 'Data pengontrak berhasil diperbarui.');
    }
    
    
    
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy(Tenant $tenant)
    {
        $tenant->delete();
        return redirect()->route('tenants.index')->with('success', 'Data pengontrak berhasil dihapus.');
    }
    

    
    
}
