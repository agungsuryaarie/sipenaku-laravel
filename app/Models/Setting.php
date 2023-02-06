pj<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Setting extends Model
    {
        use HasFactory;
        protected $table = 'setting';

        protected $fillable = [
            'judul', 'tgl_mulai', 'jam_mulai', 'tgl_selesai', 'jam_selesai'
        ];
    }
