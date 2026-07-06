<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    protected $table = 'tugas_list';
    protected $fillable = ['user_id', 'judul', 'matkul', 'deadline', 'waktu', 'done'];

    protected function casts(): array
    {
        return [
            'done' => 'boolean',
            'deadline' => 'date:Y-m-d',
        ];
    }

    public function user() { return $this->belongsTo(User::class); }
}
