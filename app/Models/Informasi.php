<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
    use HasFactory;

    protected $table = 'tb_informasi';
    protected $primaryKey = 'id_informasi';
    
    public $timestamps = false; 

    protected $fillable = [
        'kategori_info',
        'judul',
        'isi',
        'gambar',
        'tgl_posting',
        'id_admin'
    ];
    
    protected $casts = [
        'tgl_posting' => 'datetime',
    ];
}
