<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk'; // nama tabel
    protected $primaryKey = 'id_produk'; // primary key

    public $timestamps = false; // created_at & updated_at

    protected $fillable = ['nama_produk', 'harga']; // kolom yang boleh diisi
}
