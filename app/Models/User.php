<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
use HasFactory, Notifiable;

protected $primaryKey = 'id_admin';
protected $fillable = ['nama', 'email', 'password'];
protected $hidden = ['password', 'remember_token'];

public function logs()
{
return $this->hasMany(LogAktivitas::class, 'id_admin');
}
}
