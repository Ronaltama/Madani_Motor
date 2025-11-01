<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogAktivitas extends Model
{
use HasFactory;

protected $table = 'log_aktivitas';
protected $primaryKey = 'id_log';
protected $fillable = ['id_admin', 'id_mobil', 'id_review', 'aktivitas', 'tanggal'];

public function admin()
{
return $this->belongsTo(User::class, 'id_admin');
}

public function mobil()
{
return $this->belongsTo(Mobil::class, 'id_mobil');
}

public function review()
{
return $this->belongsTo(ReviewTestimoni::class, 'id_review');
}
}
