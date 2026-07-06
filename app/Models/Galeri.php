<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $fillable = ['user_id', 'judul', 'image', 'rot'];

    public function user() { return $this->belongsTo(User::class); }
}
