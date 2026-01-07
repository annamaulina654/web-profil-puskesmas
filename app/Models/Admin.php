<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'tb_admin';
    protected $primaryKey = 'id_admin';
    public $timestamps = false;

    protected $fillable = [
        'username', 'password', 'nama_lengkap',
    ];

    protected $hidden = [
        'password',
    ];
}