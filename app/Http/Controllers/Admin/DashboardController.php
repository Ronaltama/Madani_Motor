<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mobil;
use App\Models\ReviewTestimoni;
use App\Models\LogAktivitas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as AuthFacade;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display admin dashboard (cards + quick actions)
     */
    public function index()
    {
        $stats = [
            'totalProduk'   => Mobil::count(),
            'totalReview'   => ReviewTestimoni::count(),
            'totalAktivitas'=> LogAktivitas::count(),
            'totalAdmin'    => User::count(),
        ];

        $aktivitasTerbaru = LogAktivitas::orderByDesc('created_at')
            ->take(5)
            ->get(['id_log','aktivitas','created_at']);

        return Inertia::render('Admin/Dashboard', [
            'user' => AuthFacade::user(),
            'stats' => $stats,
            'aktivitasTerbaru' => $aktivitasTerbaru,
        ]);
    }
}