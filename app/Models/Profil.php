<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
use HasFactory;

    protected $table = 'tb_profil';
    protected $primaryKey = 'id_profil';

    public $timestamps = false; 

    protected $fillable = [
        'kategori_profil',
        'judul',
        'isi_konten',
        'gambar',
        'id_admin',
        'updated_at'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }
}
