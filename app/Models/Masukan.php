<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Masukan extends Model
{
    use HasFactory;

    protected $table = 'tb_masukan';
    protected $primaryKey = 'id_masukan';
    
    public $timestamps = false; 

    protected $fillable = [
        'nama_pengirim',
        'email',
        'subjek',
        'pesan',
        'tgl_kirim'
    ];
    
    protected $casts = [
        'tgl_kirim' => 'datetime',
    ];
}
