<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;
    protected $table = 'detail';

    protected $fillable = [
        'id_subkeg',
        'kode_detail',
        'nama_detail',
        'koefisien',
        'satuan',
        'harga',
        'jumlah',
    ];


    public function rekening()
    {
        return $this->belongsTo(Rekening::class, 'id_rekening');
    }
}
