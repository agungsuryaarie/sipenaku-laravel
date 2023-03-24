<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TW extends Model
{
    use HasFactory;

    protected $table = 'tw';

    protected $fillable = [
        'kegiatan_id',
        'subkegiatan_id',
        'rekening_id',
        '1',
        '2',
        '3',
        '4',
        '5',
        '6',
        '7',
        '8',
        '9',
        '10',
        '11',
        '12',

    ];
}
