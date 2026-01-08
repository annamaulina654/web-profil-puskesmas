<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;

    protected $table = 'tb_layanan';
    protected $primaryKey = 'id_layanan';
    
    public $timestamps = false; 

    protected $fillable = [
        'nama_layanan',
        'deskripsi',
        'jam_operasional',
        'foto_layanan',
        'id_admin'
    ];
}
