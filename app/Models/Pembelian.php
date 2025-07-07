<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    protected $table = 'pembelian'; // nama tabel kamu
    protected $primaryKey = 'pembelian_id'; // primary key nya
    public $timestamps = true; // created_at dan updated_at aktif

    protected $fillable = ['pelanggan_id', 'pembelian_id', 'produk_id', 'jumlah', 'total_harga'];

    // Relasi ke Pelanggan
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id', 'pelanggan_id');
    }

    // Relasi ke Produk
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'pelanggan_id');
    }
}