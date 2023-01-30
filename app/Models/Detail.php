<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;
    protected $table = 'detail';

    protected $fillable = [
        'id',
        'nama_detail',
        'spesifikasi',
        'koefisien1',
        'koefisien2',
        'satuan',
        'harga',
        'jumlah',
        // 'kegiatan_id',
        // 'subkegiatan_id',
        'rekening_id',
    ];


    public function rekening()
    {
        return $this->belongsTo(Rekening::class);
    }
}
