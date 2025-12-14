<?php

namespace App\Http\Controllers;

use App\Models\WargaAktif;
use Illuminate\Http\Request;

class WargaAktifController extends Controller
{
    public function index()
    {
        $wargaAktif = WargaAktif::paginate(10);
        return view('warga-aktif.index', compact('wargaAktif'));
    }

    public function updateStatus(Request $request, $id)
    {
        $warga = WargaAktif::findOrFail($id);
        $warga->update(['is_active' => $request->input('is_active')]);
        return redirect()->back()->with('success', 'Status berhasil diperbarui.');
    }
}