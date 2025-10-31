<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mobil;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        $mobils = Mobil::orderBy('id_mobil', 'desc')->paginate(10);
        return Inertia::render('Admin/Products/Index', [
        'mobils' => $mobils
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Products/Create');
    }

    public function store(Request $request)
{
    try {
        $validated = $request->validate([
            'nama_mobil' => 'required|string|max:255',
            'merek' => 'required|string|max:255',
            'varian' => 'nullable|string|max:255',
            'tipe_penjual' => 'required|string',
            'tahun' => 'required|integer',
            'kondisi' => 'required|string',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric'
        ]);

        $mobil = Mobil::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Data mobil berhasil ditambahkan');
    
        } catch (\Exception $e) {
        
        return redirect()->back()
            ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])
            ->withInput();
    }
}

    public function update(Request $request, Mobil $mobil)  // Changed from $product to $mobil
    {
        $validated = $request->validate([
            'nama_mobil' => 'required|string|max:255',
            'merek' => 'required|string|max:255',
            'varian' => 'nullable|string|max:255',
            'tipe_penjual' => 'required|string',
            'tahun' => 'required|integer',
            'kondisi' => 'required|string',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric'
        ]);

        $mobil->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Data mobil berhasil diperbarui');
    }

    public function destroy(Mobil $mobil)  // Changed from $product to $mobil
    {
        $mobil->delete();
        
        return redirect()->route('admin.products.index')
            ->with('success', 'Data mobil berhasil dihapus');
    }
}