<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Mobil;
use App\Models\ReviewTestimoni;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        // Get featured cars (rekomendasi)
        $rekomendasi = Mobil::with(['foto', 'spesifikasi'])
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        // Get latest cars (tahun terbaru)
        $tahunTerbaru = Mobil::with(['foto', 'spesifikasi'])
            ->orderBy('tahun', 'desc')
            ->take(4)
            ->get();

        // Get reviews/testimonials
        $reviews = ReviewTestimoni::orderBy('tanggal', 'desc')
            ->take(3)
            ->get();

        return Inertia::render('Public/Home', [
            'rekomendasi' => $rekomendasi,
            'tahunTerbaru' => $tahunTerbaru,
            'reviews' => $reviews,
        ]);
    }

    public function show($id)
    {
        $mobil = Mobil::with(['foto', 'spesifikasi'])->findOrFail($id);

        return Inertia::render('Public/DetailMobil', [
            'mobil' => $mobil,
        ]);
    }

    public function compare(Request $request)
    {
        $mobilIds = $request->query('ids', []);
        $mobils = Mobil::with(['foto', 'spesifikasi'])
            ->whereIn('id_mobil', $mobilIds)
            ->get();

        return Inertia::render('Public/CompareMobil', [
            'mobils' => $mobils,
        ]);
    }
}
