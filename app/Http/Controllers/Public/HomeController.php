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
        // Get all cars with relationships
        $cars = Mobil::with(['foto', 'spesifikasi'])
            ->get()
            ->map(function ($mobil) {
                $foto = $mobil->foto->first();
                $spek = $mobil->spesifikasi;

                return [
                    'id' => $mobil->id_mobil,
                    'name' => $mobil->nama_mobil,
                    'year' => $mobil->tahun,
                    'price' => $mobil->harga,
                    'km' => $spek ? $spek->kilometer . ' km' : '0 km',
                    'transmission' => $spek ? $spek->transmisi : 'N/A',
                    'bahanBakar' => $spek ? $spek->bahan_bakar : 'N/A',
                    'image' => $foto && $foto->full_body
                        ? asset('storage/mobils/' . $foto->full_body)
                        : asset('images/placeholder-car.png'),
                ];
            });

        // Get reviews from database
        $reviews = ReviewTestimoni::with('mobil')
            ->get()
            ->map(function ($review) {
                return [
                    'id' => $review->id_review,
                    'mobil' => $review->mobil ? $review->mobil->nama_mobil : 'Tidak Diketahui',
                    'namaPelanggan' => $review->nama_pelanggan,
                    'tanggal' => $review->tanggal ? $review->tanggal->format('d/m/Y') : '',
                    'rating' => $review->rating,
                    'isiUlasan' => $review->isi_review,
                    'foto' => $review->foto_url ? asset('storage/' . $review->foto_url) : asset('images/placeholder-review.jpg'),
                ];
            });

        return Inertia::render('Public/Home', [
            'cars' => $cars,
            'reviews' => $reviews,
        ]);
    }

    /**
     * Get all cars with filters
     */
    public function cars(Request $request): \Inertia\Response
    {
        // Get all cars with filters (search, price range, transmission)
        $query = Mobil::with(['foto', 'spesifikasi']);

        // Search filter
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('merek', 'like', "%{$search}%")
                  ->orWhere('varian', 'like', "%{$search}%")
                  ->orWhere('nama_mobil', 'like', "%{$search}%");
            });
        }

        $cars = $query->get()->map(function ($mobil) {
            $foto = $mobil->foto->first();
            $spek = $mobil->spesifikasi;

            return [
                'id' => $mobil->id_mobil,
                'name' => $mobil->nama_mobil,
                'year' => $mobil->tahun,
                'price' => $mobil->harga,
                'km' => $spek ? $spek->kilometer . ' km' : '0 km',
                'transmission' => $spek ? $spek->transmisi : 'N/A',
                'bahanBakar' => $spek ? $spek->bahan_bakar : 'N/A',
                'image' => $foto && $foto->full_body
                    ? asset('storage/mobils/' . $foto->full_body)
                    : asset('images/placeholder-car.png'),
            ];
        });

        return Inertia::render('Public/CarsList', [
            'cars' => $cars,
        ]);
    }

    /**
     * Show car details
     */
    public function show(int $id): \Inertia\Response
    {
        $mobil = Mobil::with(['foto', 'spesifikasi'])->findOrFail($id);
        $spek = $mobil->spesifikasi;

        // Format data mobil untuk detail page
        $carData = [
            'id' => $mobil->id_mobil,
            'name' => $mobil->nama_mobil,
            'year' => $mobil->tahun,
            'price' => $mobil->harga,
            'km' => $spek ? $spek->kilometer . ' km' : '0 km',
            'transmission' => $spek ? $spek->transmisi : 'N/A',
            'bahanBakar' => $spek ? $spek->bahan_bakar : 'N/A',
            'warna' => $spek ? $spek->warna : 'N/A',
            'tipe' => $spek ? $spek->tipe : 'N/A',
            'stnkValid' => $spek ? $spek->masa_berlaku : '-',
            'sistemPenggerak' => $spek ? $spek->sistem_penggerak : 'N/A',
            'noPolisi' => $spek ? $spek->nomor_polisi : '-',
            'domisili' => $spek ? $spek->plat_asal : '-',
            'description' => $mobil->deskripsi ?? 'Tidak ada deskripsi',
            'photos' => $mobil->foto->map(function ($foto) {
                $photos = [];
                // Foto wajib
                if ($foto->full_body) $photos[] = ['url' => asset('storage/mobils/' . $foto->full_body)];
                if ($foto->foto_depan) $photos[] = ['url' => asset('storage/mobils/' . $foto->foto_depan)];
                if ($foto->foto_belakang) $photos[] = ['url' => asset('storage/mobils/' . $foto->foto_belakang)];
                if ($foto->foto_kiri) $photos[] = ['url' => asset('storage/mobils/' . $foto->foto_kiri)];
                if ($foto->foto_kanan) $photos[] = ['url' => asset('storage/mobils/' . $foto->foto_kanan)];
                // Foto tambahan
                if ($foto->tambahan1) $photos[] = ['url' => asset('storage/mobils/' . $foto->tambahan1)];
                if ($foto->tambahan2) $photos[] = ['url' => asset('storage/mobils/' . $foto->tambahan2)];
                if ($foto->tambahan3) $photos[] = ['url' => asset('storage/mobils/' . $foto->tambahan3)];
                if ($foto->tambahan4) $photos[] = ['url' => asset('storage/mobils/' . $foto->tambahan4)];
                return $photos;
            })->flatten(1),
        ];

        // Get similar cars (same transmission or fuel type)
        $similarCars = Mobil::with(['foto', 'spesifikasi'])
            ->where('id_mobil', '!=', $id)
            ->get()
            ->map(function ($m) {
                $f = $m->foto->first();
                $s = $m->spesifikasi;
                return [
                    'id' => $m->id_mobil,
                    'name' => $m->nama_mobil,
                    'year' => $m->tahun,
                    'price' => $m->harga,
                    'km' => $s ? $s->kilometer . ' km' : '0 km',
                    'transmission' => $s ? $s->transmisi : 'N/A',
                    'image' => $f && $f->full_body
                        ? asset('storage/mobils/' . $f->full_body)
                        : asset('images/placeholder-car.png'),
                ];
            })
            ->take(6);

        return Inertia::render('Public/DetailMobil', [
            'car' => $carData,
            'similarCars' => $similarCars,
        ]);
    }

    public function reviews()
    {
        $reviews = ReviewTestimoni::orderBy('tanggal', 'desc')
            ->get()
            ->map(function ($review) {
                return [
                    'id_review' => $review->id_review,
                    'nama_pelanggan' => $review->nama_pelanggan,
                    'tanggal' => $review->tanggal,
                    'isi_review' => $review->isi_review,
                    'rating' => $review->rating,
                    'foto_url' => $review->foto_url ? asset('images/reviews/' . $review->foto_url) : null,
                ];
            });

        return Inertia::render('Public/Reviews', [
            'reviews' => $reviews,
        ]);
    }

    /**
     * Compare multiple cars
     */
    public function compare(Request $request): \Inertia\Response
    {
        // Get all cars for comparison
        $cars = Mobil::with(['foto', 'spesifikasi'])
            ->get()
            ->map(function ($mobil) {
                $foto = $mobil->foto->first();
                $spek = $mobil->spesifikasi;

                return [
                    'id' => $mobil->id_mobil,
                    'name' => $mobil->nama_mobil,
                    'year' => $mobil->tahun,
                    'price' => $mobil->harga,
                    'merek' => $mobil->merek,
                    'varian' => $mobil->varian,
                    'kondisi' => $mobil->kondisi,
                    'deskripsi' => $mobil->deskripsi,
                    'km' => $spek ? $spek->kilometer : null,
                    'transmission' => $spek ? $spek->transmisi : null,
                    'bahanBakar' => $spek ? $spek->bahan_bakar : null,
                    'tipe' => $spek ? $spek->tipe : null,
                    'sistemPenggerak' => $spek ? $spek->sistem_penggerak : null,
                    'image' => $foto && $foto->full_body
                        ? asset('storage/mobils/' . $foto->full_body)
                        : asset('images/placeholder-car.png'),
                ];
            });

        // Get selected car IDs from URL parameters
        $selectedCarIds = [];
        if ($request->has('cars')) {
            $selectedCarIds = explode(',', $request->get('cars'));
            $selectedCarIds = array_filter($selectedCarIds, 'is_numeric');
        }

        return Inertia::render('Public/Compare', [
            'cars' => $cars,
            'selected' => $selectedCarIds,
        ]);
    }
}
