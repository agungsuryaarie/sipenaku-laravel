<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subkegiatan extends Model
{
    use HasFactory;
    protected $table = 'subkegiatan';

    protected $fillable = [
        'kegiatan_id',
        'kode_sub',
        'nama_sub',
        'pagu_sub'
    ];


    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }
}
