<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpesifikasiMobil extends Model
{
use HasFactory;

protected $table = 'spesifikasi_mobils';
protected $fillable = [
'id_mobil', 'tipe', 'bahan_bakar', 'sistem_penggerak', 'transmisi',
'kilometer', 'plat_asal', 'nomor_polisi', 'masa_berlaku',
'spare_key', 'toolkit', 'warna'
];

public function mobil()
{
return $this->belongsTo(Mobil::class, 'id_mobil');
}
}
