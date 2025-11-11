<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mobil;
use App\Models\SpesifikasiMobil;
use App\Models\FotoMobil;
use App\Models\LogAktivitas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $mobils = Mobil::with('spesifikasi')
            ->when($search, function ($query, $search) {
                return $query->where('nama_mobil', 'like', '%' . $search . '%')
                    ->orWhere('merek', 'like', '%' . $search . '%')
                    ->orWhere('varian', 'like', '%' . $search . '%')
                    ->orWhere('id_mobil', 'like', '%' . $search . '%');
            })
            ->orderBy('id_mobil', 'desc')
            ->paginate(10)
            ->withQueryString();

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
            // Validasi data mobil
            $validated = $request->validate([
                'nama_mobil' => 'required|string|max:255',
                'merek' => 'required|string|max:255',
                'varian' => 'nullable|string|max:255',
                'tipe_penjual' => 'nullable|string',
                'tahun' => 'nullable|integer',
                'kondisi' => 'required|string',
                'deskripsi' => 'nullable|string',
                'harga' => 'nullable|numeric',
                // Spesifikasi
                'tipe' => 'nullable|string',
                'bahan_bakar' => 'nullable|string',
                'sistem_penggerak' => 'nullable|string',
                'transmisi' => 'nullable|string',
                'kilometer' => 'nullable|integer',
                'plat_asal' => 'nullable|string',
                'nomor_polisi' => 'nullable|string',
                'masa_berlaku' => 'nullable|date',
                'spare_key' => 'nullable|string',
                'toolkit' => 'nullable|string',
                'warna' => 'nullable|string',
                // Foto
                'full_body' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'foto_depan' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'foto_belakang' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'foto_kiri' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'foto_kanan' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'tambahan1' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'tambahan2' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'tambahan3' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'tambahan4' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            ]);

            // Simpan data mobil
            $mobil = Mobil::create([
                'nama_mobil' => $validated['nama_mobil'],
                'merek' => $validated['merek'],
                'varian' => $validated['varian'] ?? null,
                'tipe_penjual' => $validated['tipe_penjual'] ?? null,
                'tahun' => $validated['tahun'] ?? null,
                'kondisi' => $validated['kondisi'],
                'deskripsi' => $validated['deskripsi'] ?? null,
                'harga' => $validated['harga'] ?? null,
            ]);

            // Simpan spesifikasi mobil
            SpesifikasiMobil::create([
                'id_mobil' => $mobil->id_mobil,
                'tipe' => $validated['tipe'] ?? null,
                'bahan_bakar' => $validated['bahan_bakar'] ?? null,
                'sistem_penggerak' => $validated['sistem_penggerak'] ?? null,
                'transmisi' => $validated['transmisi'] ?? null,
                'kilometer' => $validated['kilometer'] ?? null,
                'plat_asal' => $validated['plat_asal'] ?? null,
                'nomor_polisi' => $validated['nomor_polisi'] ?? null,
                'masa_berlaku' => $validated['masa_berlaku'] ?? null,
                'spare_key' => $validated['spare_key'] ?? null,
                'toolkit' => $validated['toolkit'] ?? null,
                'warna' => $validated['warna'] ?? null,
            ]);

            // Simpan foto mobil
            $fotoData = ['id_mobil' => $mobil->id_mobil];

            foreach (['full_body', 'foto_depan', 'foto_belakang', 'foto_kiri', 'foto_kanan', 'tambahan1', 'tambahan2', 'tambahan3', 'tambahan4'] as $field) {
                if ($request->hasFile($field)) {
                    $path = $request->file($field)->store('mobils', 'public');
                    $fotoData[$field] = basename($path);
                }
            }

            FotoMobil::create($fotoData);

            // Log aktivitas
            try {
                LogAktivitas::create([
                    'id_admin' => Auth::id(),
                    'id_mobil' => $mobil->id_mobil,
                    'id_review' => null,
                    'aktivitas' => 'Menambah data mobil: ' . $mobil->nama_mobil,
                    'tanggal' => now()->toDateString(),
                ]);
            } catch (\Throwable $th) {
                // Silent
            }

            return redirect()->route('admin.products.index')
                ->with('success', 'Data mobil berhasil ditambahkan');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function edit(Mobil $mobil)
    {
        $mobil->load(['spesifikasi', 'foto']);

        return Inertia::render('Admin/Products/Edit', [
            'mobil' => $mobil
        ]);
    }

    public function update(Request $request, Mobil $mobil)
    {
        try {
            // Validasi
            $validated = $request->validate([
                'nama_mobil' => 'required|string|max:255',
                'merek' => 'required|string|max:255',
                'varian' => 'nullable|string|max:255',
                'tipe_penjual' => 'nullable|string',
                'tahun' => 'nullable|integer',
                'kondisi' => 'required|string',
                'deskripsi' => 'nullable|string',
                'harga' => 'nullable|numeric',
                // Spesifikasi
                'tipe' => 'nullable|string',
                'bahan_bakar' => 'nullable|string',
                'sistem_penggerak' => 'nullable|string',
                'transmisi' => 'nullable|string',
                'kilometer' => 'nullable|integer',
                'plat_asal' => 'nullable|string',
                'nomor_polisi' => 'nullable|string',
                'masa_berlaku' => 'nullable|date',
                'spare_key' => 'nullable|string',
                'toolkit' => 'nullable|string',
                'warna' => 'nullable|string',
                // Foto
                'full_body' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'foto_depan' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'foto_belakang' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'foto_kiri' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'foto_kanan' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'tambahan1' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'tambahan2' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'tambahan3' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'tambahan4' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            ]);

            // Update mobil
            $mobil->update([
                'nama_mobil' => $validated['nama_mobil'],
                'merek' => $validated['merek'],
                'varian' => $validated['varian'] ?? null,
                'tipe_penjual' => $validated['tipe_penjual'] ?? null,
                'tahun' => $validated['tahun'] ?? null,
                'kondisi' => $validated['kondisi'],
                'deskripsi' => $validated['deskripsi'] ?? null,
                'harga' => $validated['harga'] ?? null,
            ]);

            // Update spesifikasi
            $mobil->spesifikasi()->updateOrCreate(
                ['id_mobil' => $mobil->id_mobil],
                [
                    'tipe' => $validated['tipe'] ?? null,
                    'bahan_bakar' => $validated['bahan_bakar'] ?? null,
                    'sistem_penggerak' => $validated['sistem_penggerak'] ?? null,
                    'transmisi' => $validated['transmisi'] ?? null,
                    'kilometer' => $validated['kilometer'] ?? null,
                    'plat_asal' => $validated['plat_asal'] ?? null,
                    'nomor_polisi' => $validated['nomor_polisi'] ?? null,
                    'masa_berlaku' => $validated['masa_berlaku'] ?? null,
                    'spare_key' => $validated['spare_key'] ?? null,
                    'toolkit' => $validated['toolkit'] ?? null,
                    'warna' => $validated['warna'] ?? null,
                ]
            );

            // Update foto
            $foto = $mobil->foto()->firstOrNew(['id_mobil' => $mobil->id_mobil]);

            foreach (['full_body', 'foto_depan', 'foto_belakang', 'foto_kiri', 'foto_kanan', 'tambahan1', 'tambahan2', 'tambahan3', 'tambahan4'] as $field) {
                if ($request->hasFile($field)) {
                    // Hapus foto lama
                    if ($foto->$field) {
                        Storage::disk('public')->delete('mobils/' . $foto->$field);
                    }
                    // Upload foto baru
                    $path = $request->file($field)->store('mobils', 'public');
                    $foto->$field = basename($path);
                }
            }

            $foto->save();

            // Log aktivitas
            try {
                LogAktivitas::create([
                    'id_admin' => Auth::id(),
                    'id_mobil' => $mobil->id_mobil,
                    'id_review' => null,
                    'aktivitas' => 'Memperbarui data mobil: ' . $mobil->nama_mobil,
                    'tanggal' => now()->toDateString(),
                ]);
            } catch (\Throwable $th) {
                // Silent
            }

            return redirect()->route('admin.products.index')
                ->with('success', 'Data mobil berhasil diperbarui');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function destroy(Mobil $mobil)
    {
        try {
            $nama = $mobil->nama_mobil;

            // Hapus foto dari storage terlebih dahulu
            $fotos = $mobil->foto;
            if ($fotos) {
                foreach ($fotos as $foto) {
                    $fotoFields = ['full_body', 'foto_depan', 'foto_belakang', 'foto_kiri', 'foto_kanan',
                                  'tambahan1', 'tambahan2', 'tambahan3', 'tambahan4'];

                    foreach ($fotoFields as $field) {
                        if ($foto->$field) {
                            Storage::disk('public')->delete('mobils/' . $foto->$field);
                        }
                    }
                }
            }

            // Hapus mobil (cascade delete akan handle spesifikasi dan foto dari database)
            $mobil->delete();

            // Log aktivitas
            try {
                LogAktivitas::create([
                    'id_admin' => Auth::id(),
                    'id_mobil' => null,
                    'id_review' => null,
                    'aktivitas' => 'Menghapus data mobil: ' . $nama,
                    'tanggal' => now()->toDateString(),
                ]);
            } catch (\Throwable $th) {
                // Silent log error
            }

            return redirect()->route('admin.products.index')
                ->with('success', 'Data mobil "' . $nama . '" berhasil dihapus');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat menghapus mobil: ' . $e->getMessage()]);
        }
    }

    public function show(Mobil $mobil)
    {
        $mobil->load(['spesifikasi', 'foto']);

        // Format foto paths dengan base URL yang benar
        $mobilData = $mobil->toArray();
        if ($mobil->foto && $mobil->foto->count() > 0) {
            $foto = $mobil->foto->first();
            $mobilData['foto_formatted'] = [
                'full_body' => $foto->full_body ? asset('storage/mobils/' . $foto->full_body) : null,
                'foto_depan' => $foto->foto_depan ? asset('storage/mobils/' . $foto->foto_depan) : null,
                'foto_belakang' => $foto->foto_belakang ? asset('storage/mobils/' . $foto->foto_belakang) : null,
                'foto_kiri' => $foto->foto_kiri ? asset('storage/mobils/' . $foto->foto_kiri) : null,
                'foto_kanan' => $foto->foto_kanan ? asset('storage/mobils/' . $foto->foto_kanan) : null,
                'tambahan1' => $foto->tambahan1 ? asset('storage/mobils/' . $foto->tambahan1) : null,
                'tambahan2' => $foto->tambahan2 ? asset('storage/mobils/' . $foto->tambahan2) : null,
                'tambahan3' => $foto->tambahan3 ? asset('storage/mobils/' . $foto->tambahan3) : null,
                'tambahan4' => $foto->tambahan4 ? asset('storage/mobils/' . $foto->tambahan4) : null,
            ];
        } else {
            // Jika tidak ada foto, buat struktur kosong
            $mobilData['foto_formatted'] = [
                'full_body' => null,
                'foto_depan' => null,
                'foto_belakang' => null,
                'foto_kiri' => null,
                'foto_kanan' => null,
                'tambahan1' => null,
                'tambahan2' => null,
                'tambahan3' => null,
                'tambahan4' => null,
            ];
        }

        return Inertia::render('Admin/Products/Show', [
            'mobil' => $mobilData
        ]);
    }
}
