<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SPJ extends Model
{
    use HasFactory;

    protected $table = "spj";

    protected $fillable = [
        'tanggal', 'bagian_id', 'kegiatan_id', 'subkegiatan_id', 'rekening_id', 'uraian', 'kwitansi', 'nama_penerima', 'alamat_penerima', 'jenis_spm', 'file', 'status', 'alasan'
    ];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }

    public function subkegiatan()
    {
        return $this->belongsTo(Subkegiatan::class);
    }

    public function rekening()
    {
        return $this->belongsTo(Rekening::class);
    }
    public function bagian()
    {
        return $this->belongsTo(Bagian::class);
    }
}
