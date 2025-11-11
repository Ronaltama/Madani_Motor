<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
use HasFactory;

protected $table = 'mobils';
protected $primaryKey = 'id_mobil';
protected $fillable = [
'nama_mobil', 'merek', 'varian', 'tipe_penjual',
'tahun', 'kondisi', 'deskripsi', 'harga'
];

public function spesifikasi()
{
return $this->hasOne(SpesifikasiMobil::class, 'id_mobil');
}

public function foto()
{
return $this->hasMany(FotoMobil::class, 'id_mobil');
}

public function reviews()
{
return $this->hasMany(ReviewTestimoni::class, 'id_mobil');
}

public function logs()
{
return $this->hasMany(LogAktivitas::class, 'id_mobil');
}
}
