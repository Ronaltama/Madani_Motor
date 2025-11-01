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
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return Inertia::render('Admin/LogAktivitas/Index', [
            'logs' => $logs
        ]);
    }
}