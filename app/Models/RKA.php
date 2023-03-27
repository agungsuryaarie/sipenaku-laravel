<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RKA extends Model
{
    use HasFactory;

    protected $table = 'rka';

    protected $fillable = [
        'rekening_id',
        'january',
        'february',
        'march',
        'april',
        'may',
        'june',
        'july',
        'august',
        'september',
        'october',
        'november',
        'december',

    ];

    public function rekening()
    {
        return $this->belongsTo(Rekening::class);
    }
}
