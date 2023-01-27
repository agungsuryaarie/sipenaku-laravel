<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;
    protected $table = 'kegiatan';

    protected $fillable = [
        'kode_kegiatan',
        'nama_kegiatan',
        'id_bagian',
    ];

    public function bagian()
    {
        return $this->belongsTo(Bagian::class, 'id_bagian');
    }

    public function subkegiatan()
    {
        return $this->hasMany(Subkegiatan::class, 'id_kegiatan');
    }
}
