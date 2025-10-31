<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mobil;
use App\Models\LogAktivitas;
use App\Models\FotoMobil;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
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
            'harga' => 'required|numeric',
            // Foto opsional
            'foto_depan' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'foto_belakang' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'foto_kiri' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'foto_kanan' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $mobil = Mobil::create($validated);

        // Simpan foto jika ada
        $fotoData = [];
        $dest = public_path('images/mobils');
        if (!File::exists($dest)) {
            File::makeDirectory($dest, 0755, true);
        }

        foreach (['foto_depan','foto_belakang','foto_kiri','foto_kanan'] as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = uniqid($field.'_').'.'.$file->getClientOriginalExtension();
                $file->move($dest, $filename);
                $fotoData[$field] = '/images/mobils/'.$filename;
            }
        }

        if (!empty($fotoData)) {
            $fotoData['id_mobil'] = $mobil->id_mobil;
            FotoMobil::create($fotoData);
        }

        // Catat log aktivitas
        try {
            LogAktivitas::create([
                'id_admin' => Auth::id(),
                'id_mobil' => $mobil->id_mobil ?? null,
                'id_review' => null,
                'aktivitas' => 'Menambah data mobil: ' . ($mobil->nama_mobil ?? ''),
                'tanggal' => now()->toDateString(),
            ]);
        } catch (\Throwable $th) {
            // Jangan gagalkan penyimpanan mobil jika logging gagal
        }

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
            'harga' => 'required|numeric',
            'foto_depan' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'foto_belakang' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'foto_kiri' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'foto_kanan' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $mobil->update($validated);

        // Update foto jika dikirim
        $dest = public_path('images/mobils');
        if (!File::exists($dest)) {
            File::makeDirectory($dest, 0755, true);
        }

        $foto = $mobil->foto ?: new FotoMobil(['id_mobil' => $mobil->id_mobil]);
        $changed = false;
        foreach (['foto_depan','foto_belakang','foto_kiri','foto_kanan'] as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = uniqid($field.'_').'.'.$file->getClientOriginalExtension();
                $file->move($dest, $filename);
                $foto->{$field} = '/images/mobils/'.$filename;
                $changed = true;
            }
        }
        if ($changed) {
            $foto->save();
        }

        // Catat log aktivitas
        try {
            LogAktivitas::create([
                'id_admin' => Auth::id(),
                'id_mobil' => $mobil->id_mobil ?? null,
                'id_review' => null,
                'aktivitas' => 'Memperbarui data mobil: ' . ($mobil->nama_mobil ?? ''),
                'tanggal' => now()->toDateString(),
            ]);
        } catch (\Throwable $th) {
            // silent
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Data mobil berhasil diperbarui');
    }

    public function destroy(Mobil $mobil)  // Changed from $product to $mobil
    {
        $mobil->delete();

        // Catat log aktivitas
        try {
            LogAktivitas::create([
                'id_admin' => Auth::id(),
                'id_mobil' => $mobil->id_mobil ?? null,
                'id_review' => null,
                'aktivitas' => 'Menghapus data mobil: ' . ($mobil->nama_mobil ?? ''),
                'tanggal' => now()->toDateString(),
            ]);
        } catch (\Throwable $th) {
            // silent
        }
        
        return redirect()->route('admin.products.index')
            ->with('success', 'Data mobil berhasil dihapus');
    }

    public function show(Mobil $mobil)
    {
        $mobil->load('foto');
        return Inertia::render('Admin/Products/Show', [
            'mobil' => $mobil
        ]);
    }
}