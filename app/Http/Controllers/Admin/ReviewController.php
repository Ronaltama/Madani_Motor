<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReviewTestimoni;
use App\Models\LogAktivitas;
use Illuminate\Support\Facades\Auth;
use App\Models\Mobil;
use Inertia\Inertia;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $total = ReviewTestimoni::count();

        // Ambil merek unik dari tabel mobils
        $brands = Mobil::query()->select('merek')->distinct()->pluck('merek');

        // Kelompokkan MOBIL per merek, sertakan ulasan terbaru per mobil (agar mobil baru tetap muncul walau belum ada ulasan)
        $groups = [];
        foreach ($brands as $brand) {
            $mobils = Mobil::where('merek', $brand)
                ->orderBy('nama_mobil')
                ->get();

            $mobilsPayload = $mobils->map(function ($m) {
                $latestReviews = ReviewTestimoni::where('id_mobil', $m->id_mobil)
                    ->latest()
                    ->take(3)
                    ->get(['id_review','id_mobil','nama_pelanggan','tanggal','isi_review','rating','foto_url'])
                    ->map(function ($r) {
                        return [
                            'id_review' => $r->id_review,
                            'nama_pelanggan' => $r->nama_pelanggan,
                            'tanggal' => $r->tanggal,
                            'isi_review' => $r->isi_review,
                            'rating' => $r->rating,
                            'foto_url' => $r->foto_url,
                        ];
                    });

                return [
                    'id_mobil' => $m->id_mobil,
                    'nama_mobil' => $m->nama_mobil,
                    'merek' => $m->merek,
                    'reviews' => $latestReviews,
                ];
            });

            $groups[] = [
                'merek' => $brand,
                'mobils' => $mobilsPayload,
            ];
        }

        // List mobil untuk form (opsional grouping di frontend)
        $mobils = Mobil::orderBy('merek')->orderBy('nama_mobil')->get(['id_mobil','merek','nama_mobil']);

        return Inertia::render('Admin/Reviews/Index', [
            'total' => $total,
            'groups' => $groups,
            'mobils' => $mobils,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        ]);

        $review = ReviewTestimoni::create($validated);

        // log aktivitas (best-effort)
        try {
            LogAktivitas::create([
                'id_admin' => Auth::id(),
                'id_mobil' => null,
                'id_review' => $review->id_review ?? null,
                'aktivitas' => 'Menambah ulasan pelanggan: ' . ($review->nama_pelanggan ?? ''),
                'tanggal' => now()->toDateString(),
            ]);
        } catch (\Throwable $th) {
            // ignore if logging fails
        }

        return redirect()->route('admin.reviews.index')
            ->with('success', 'Ulasan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
