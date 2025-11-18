<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewTestimoni extends Model
{
use HasFactory;

protected $table = 'review_testimonis';
protected $primaryKey = 'id_review';
protected $fillable = [
	'nama_mobil', 'nama_pelanggan', 'tanggal', 'isi_review', 'rating', 'foto_url'
];

protected $casts = [
	'tanggal' => 'date',
];

// Tidak perlu relasi ke mobil karena menggunakan nama_mobil sebagai string
// public function mobil()
// {
// return $this->belongsTo(Mobil::class, 'id_mobil');
// }

public function logs()
{
return $this->hasMany(LogAktivitas::class, 'id_review');
}
}
