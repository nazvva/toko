<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggan'; // Nama tabel di database
    protected $primaryKey = 'pelanggan_id';
    protected $fillable = ['nama_pelanggan', 'alamat', 'telepon'];

     public function pembelians()
    {
        return $this->hasMany(Pembelian::class, 'pelanggan_id', 'pelanggan_id');

    }
}
