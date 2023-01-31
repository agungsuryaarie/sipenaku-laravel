<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    use HasFactory;
    protected $table = 'users';

    protected $fillable = [
        'bagian_id', 'nip', 'nama', 'nohp', 'email', 'username', 'password', 'foto', 'level', 'status'
    ];

    public function bagian()
    {
        return $this->belongsTo(Bagian::class);
    }
}
