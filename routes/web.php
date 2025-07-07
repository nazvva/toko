<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PembelianController; // Tambahkan ini

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('pelanggan', PelangganController::class);
Route::resource('produk', ProdukController::class); // Tambahkan ini
Route::resource('pembelian', PembelianController::class); // Tambahkan ini
Route::get('/produk-price/{id}', [PembelianController::class, 'getProductPrice']); //route baru


//pembelian
Route::get('/pembelian/create', [PembelianController::class, 'create'])->name('pembelian.create');
Route::post('/pembelian', [PembelianController::class, 'store'])->name('pembelian.store');
Route::get('/pembelian/{pembelian}/edit', [PembelianController::class, 'edit'])->name('pembelian.edit');
Route::put('/pembelian/{pembelian}', [PembelianController::class, 'update'])->name('pembelian.update');
Route::get('/produk-price/{id}', [PembelianController::class, 'getProductPrice']);
Route::get('pembelian/{id_pembelian}', [PembelianController::class, 'show'])->name('pembelian.show');
Route::get('/pembelians', [PembelianController::class, 'index']);
Route::get('/pembelians/pelanggan/{id}', [PembelianController::class, 'pembelianByPelanggan']);
Route::get('/pembelian', [PembelianController::class, 'index']);
Route::post('/pembelian', [PembelianController::class, 'store']);
Route::get('/pembelian', [PembelianController::class, 'index'])->name('pembelian.index');
Route::resource('pembelian', PembelianController::class);


//pelanggan
Route::resource('pelanggan', PelangganController::class);
Route::resource('pelanggan', PelangganController::class);
Route::post('pelanggan/{id}/tambah-pembelian', [PelangganController::class, 'tambahPembelian'])->name('pelanggan.tambahPembelian');


Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
Route::get('/produk/create', [ProdukController::class, 'create'])->name('produk.create');
Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');