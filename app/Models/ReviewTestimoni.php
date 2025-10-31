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
'nama_pelanggan', 'tanggal', 'isi_review', 'rating', 'foto_url'
];

public function logs()
{
return $this->hasMany(LogAktivitas::class, 'id_review');
}
}
