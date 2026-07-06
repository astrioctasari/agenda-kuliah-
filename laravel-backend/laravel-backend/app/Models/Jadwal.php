<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $fillable = ['user_id', 'hari', 'matkul', 'mulai', 'selesai', 'ruang'];

    public function user() { return $this->belongsTo(User::class); }
}
