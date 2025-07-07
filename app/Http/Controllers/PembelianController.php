<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\Pelanggan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $pembelian = Pembelian::with(['pelanggan', 'produk'])->orderBy('pembelian_id', 'desc')->paginate(10);
            $pelanggans = Pelanggan::orderBy('pelanggan_id', 'asc')->get();
            $produks = Produk::orderBy('pelanggan_id', 'asc')->get();
            return view('pembelian.index', compact('pembelian', 'pelanggans', 'produks'));
        } catch (\Exception $e) {
            \Log::error('Error in PembelianController@index: ' . $e->getMessage());
            $emptyCollection = new Collection();
            $pembelian = new LengthAwarePaginator($emptyCollection, 0, 10);
             $pelanggans = Pelanggan::orderBy('pelanggan_id', 'asc')->get();
            $produks = Produk::orderBy('produk_id', 'asc')->get();
            return view('pembelian.index', ['pembelian' => $pembelian, 'error' => 'Terjadi kesalahan saat mengambil data pembelian. Silakan coba lagi nanti.', 'pelanggans' => $pelanggans, 'produks' => $produks]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pelanggans = Pelanggan::orderBy('id', 'asc')->get();
        $produks = Produk::orderBy('id', 'asc')->get();
        return view('pembelian.create', compact('pelanggans', 'produks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggan,id',
            'produk_id' => 'required|exists:produk,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        try {
            $produk = Produk::findOrFail($request->produk_id);
            $total_harga = $produk->harga * $request->jumlah;

            Pembelian::create([
                'pelanggan_id' => $request->pelanggan_id,
                'produk_id' => $request->produk_id,
                'jumlah' => $request->jumlah,
                'total_harga' => $total_harga,
            ]);

            return redirect()->route('pembelian.index')->with('success', 'Pembelian berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan pembelian: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    // public function show(Pembelian $pembelian)
    // {
    //     // Anda bisa menambahkan logika untuk menampilkan detail pembelian jika diperlukan
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    // public function edit(Pembelian $pembelian)
    // {
    //     // Jika Anda memerlukan fungsi edit, tambahkan logika di sini
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Pembelian $pembelian)
    // {
    //     // Jika Anda memerlukan fungsi update, tambahkan logika di sini
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pembelian $pembelian)
    {
        try {
            $pembelian->delete();
            return redirect()->route('pembelian.index')->with('success', 'Pembelian berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus pembelian: ' . $e->getMessage());
        }
    }
}