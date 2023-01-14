<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $primaryKey = 'id_barang';
    protected $keyType = 'string';
    protected $fillable = ['nama_barang','gambar_barang', 'deskripsi_barang', ];

    public function detail_barang()
    {
        return $this->hasMany(DetailBarang::class);
    }
}
