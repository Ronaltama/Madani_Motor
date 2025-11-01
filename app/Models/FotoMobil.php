<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoMobil extends Model
{
use HasFactory;

protected $table = 'foto_mobils';
protected $fillable = [
'id_mobil', 'full_body', 'foto_depan', 'foto_belakang',
'foto_kiri', 'foto_kanan', 'tambahan1', 'tambahan2', 'tambahan3', 'tambahan4'
];

public function mobil()
{
return $this->belongsTo(Mobil::class, 'id_mobil');
}
}