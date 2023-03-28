<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
    use HasFactory;
    protected $table = 'rekening';

    protected $fillable = [
        'id',
        'subkegiatan_id',
        'kode_rekening',
        'nama_rekening',
        'pagu_rekening',
        'sisa_rekening'
    ];


    public function subkegiatan()
    {
        return $this->belongsTo(Subkegiatan::class);
    }
    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }
    public function rka()
    {
        return $this->hasMany(RKA::class);
    }
}
