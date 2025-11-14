<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReviewTestimoni;
use App\Models\LogAktivitas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = ReviewTestimoni::with('mobil')
            ->orderBy('created_at', 'desc')
            ->get();

        return Inertia::render('Admin/Reviews/Index', [
            'reviews' => $reviews
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mobils = \App\Models\Mobil::orderBy('merek')->orderBy('nama_mobil')->get();

        return Inertia::render('Admin/Reviews/Create', [
            'mobils' => $mobils
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_mobil' => 'required|exists:mobils,id_mobil',
            'nama_pelanggan' => 'required|string|max:255',
            'tanggal' => 'nullable|date',
            'isi_review' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'foto_url' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Handle foto upload jika ada (gunakan storage public seperti produk)
        if ($request->hasFile('foto_url')) {
            $path = $request->file('foto_url')->store('reviews', 'public');
            // Simpan path yang bisa langsung dipakai di <img src>
            $validated['foto_url'] = '/storage/' . $path; // contoh: /storage/reviews/xxxx.jpg
        }

        $review = ReviewTestimoni::create($validated);

        $this->logReviewActivity($review, 'Menambah ulasan pelanggan');

        return redirect()->route('admin.reviews.index')
            ->with('success', 'Ulasan berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ReviewTestimoni $review)
    {
        $mobils = \App\Models\Mobil::orderBy('merek')->orderBy('nama_mobil')->get();
        
        // Load mobil relation to ensure data is available
        $review->load('mobil');


        return Inertia::render('Admin/Reviews/Edit', [
            'review' => $review,
            'mobils' => $mobils
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ReviewTestimoni $review)
    {
        $validated = $request->validate([

            'id_mobil' => 'required|exists:mobils,id_mobil',

            'nama_pelanggan' => 'required|string|max:255',
            'tanggal' => 'nullable|date',
            'isi_review' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'foto_url' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Handle foto upload jika ada
        if ($request->hasFile('foto_url')) {
            // Hapus foto lama jika ada (dukung lokasi lama dan baru)
            if ($review->foto_url) {
                if (str_starts_with($review->foto_url, '/storage/')) {
                    // path disimpan seperti /storage/reviews/xxx.jpg -> remove prefix untuk delete
                    $relative = ltrim(str_replace('/storage/', '', $review->foto_url), '/');
                    Storage::disk('public')->delete($relative);
                } else {
                    // legacy: public/images/reviews
                    @unlink(public_path($review->foto_url));
                }
            }

            $path = $request->file('foto_url')->store('reviews', 'public');
            $validated['foto_url'] = '/storage/' . $path;

        } else {
            // Jika tidak ada upload foto baru, pertahankan foto lama
            // Hapus foto_url dari validated agar tidak di-update ke null
            unset($validated['foto_url']);

        }

        $review->update($validated);

        $this->logReviewActivity($review, 'Memperbarui ulasan pelanggan');

        return redirect()->route('admin.reviews.index')
            ->with('success', 'Ulasan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReviewTestimoni $review)
    {

        // Simpan data sebelum dihapus untuk log
        $namaPelanggan = $review->nama_pelanggan;
        $idReview = $review->id_review;

        // Hapus foto jika ada
        if ($review->foto_url) {
            if (str_starts_with($review->foto_url, '/storage/')) {
                $relative = ltrim(str_replace('/storage/', '', $review->foto_url), '/');
                Storage::disk('public')->delete($relative);
            } else {
                @unlink(public_path($review->foto_url));
            }
        }

        // Log terlebih dulu (FK masih ada, nanti otomatis SET NULL karena onDelete('set null'))
        $this->logReviewActivity($review, 'Menghapus ulasan pelanggan');

        // Baru hapus review
        $review->delete();

        return redirect()->route('admin.reviews.index')
            ->with('success', 'Ulasan berhasil dihapus');
    }

    /**
     * Catat aktivitas terkait review (best-effort tanpa menghentikan proses utama)
     */
    private function logReviewActivity($review, string $action): void
    {
        try {
            LogAktivitas::create([
                'id_admin' => Auth::id(),
                'id_mobil' => $review->id_mobil ?? null,
                'id_review' => $review->id_review ?? null,
                'id_review_snapshot' => $review->id_review ?? null,
                'aktivitas' => $action . ' (ID Review: ' . ($review->id_review ?? '-') . ', Pelanggan: ' . ($review->nama_pelanggan ?? '-') . ')',
                'tanggal' => now()->toDateString(),
            ]);
        } catch (\Throwable $th) {
            // silent fail
        }
    }
}
