<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'nama',
        'hp',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function jadwals() { return $this->hasMany(Jadwal::class); }
    public function catatans() { return $this->hasMany(Catatan::class); }
    public function tugas() { return $this->hasMany(Tugas::class); }
    public function galeris() { return $this->hasMany(Galeri::class); }
}
