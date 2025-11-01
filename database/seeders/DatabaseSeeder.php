<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Mobil;
use App\Models\SpesifikasiMobil;
use App\Models\FotoMobil;
use App\Models\ReviewTestimoni;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::create([
            'nama' => 'Admin Madani Motor',
            'email' => 'admin@madanimotor.com',
            'password' => Hash::make('admin123'),
        ]);

        $mobils = [
            [
                'nama_mobil' => 'Mobil Oke X LQ 2022',
                'merek' => 'Toyota',
                'varian' => 'Corolla',
                'tipe_penjual' => 'Dealer',
                'tahun' => 2022,
                'kondisi' => 'Bekas',
                'deskripsi' => 'Mobil dalam kondisi sangat baik',
                'harga' => 250000000,
            ],
            [
                'nama_mobil' => 'Mobil Oke X LQ 2022',
                'merek' => 'Honda',
                'varian' => 'Civic',
                'tipe_penjual' => 'Dealer',
                'tahun' => 2022,
                'kondisi' => 'Bekas',
                'deskripsi' => 'Honda Civic 2022',
                'harga' => 280000000,
            ],
        ];

        foreach ($mobils as $mobilData) {
            $mobil = Mobil::create($mobilData);

            SpesifikasiMobil::create([
                'id_mobil' => $mobil->id_mobil,
                'tipe' => 'Sedan',
                'bahan_bakar' => 'Bensin',
                'sistem_penggerak' => 'FWD',
                'transmisi' => 'Automatic',
                'kilometer' => 30000,
                'plat_asal' => 'Jakarta',
                'nomor_polisi' => 'B 1234 ABC',
                'masa_berlaku' => '2026-12-31',
                'spare_key' => 'Ada',
                'toolkit' => 'Lengkap',
                'warna' => 'Hitam',
            ]);

            FotoMobil::create([
                'id_mobil' => $mobil->id_mobil,
            ]);
        }

        ReviewTestimoni::create([
            'nama_pelanggan' => 'Budi Santoso',
            'tanggal' => '2025-01-15',
            'isi_review' => 'Mantap Sekali, Pelayanannya Ramah',
            'rating' => 5,
        ]);
    }
}
