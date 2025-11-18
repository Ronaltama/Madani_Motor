<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogAktivitas;
use Inertia\Inertia;

class LogAktivitasController extends Controller
{
    public function index()
    {
        $logs = LogAktivitas::with('admin')
            ->where(function($query) {
                // Hanya tampilkan log yang punya id_review ATAU tidak ada id_review tapi ada id_mobil
                $query->whereNotNull('id_review')
                      ->orWhere(function($q) {
                          $q->whereNull('id_review')->whereNotNull('id_mobil');
                      });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return Inertia::render('Admin/LogAktivitas/Index', [
            'logs' => $logs
        ]);
    }
}
