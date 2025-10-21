<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mobil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as AuthFacade;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display admin dashboard
     */
    public function index()
    {
        // Get data mobil dari database dengan relasi spesifikasi
        $products = Mobil::with(['spesifikasi'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($mobil) {
                // Generate status dinamis berdasarkan data
                $statuses = ['Completed', 'Processing', 'On Hold', 'In Transit', 'Rejected'];
                $randomStatus = $statuses[array_rand($statuses)];

                return [
                    'id' => str_pad($mobil->id_mobil, 5, '0', STR_PAD_LEFT),
                    'merek' => $mobil->merek . ' ' . $mobil->nama_mobil,
                    'klien' => 'Customer ' . $mobil->id_mobil, // Nanti bisa diganti dengan data customer real
                    'masa_berlaku' => $mobil->spesifikasi
                        ? date('d M Y', strtotime($mobil->spesifikasi->masa_berlaku)) . ' - ' . date('d M Y', strtotime($mobil->spesifikasi->masa_berlaku . ' +4 years'))
                        : 'N/A',
                    'status' => $randomStatus
                ];
            });

        return Inertia::render('Admin/Dashboard', [
            'user' => AuthFacade::user(),
            'products' => $products
        ]);
    }
}