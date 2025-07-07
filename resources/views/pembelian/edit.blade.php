@extends('layouts.app')

@section('title', 'Edit Pembelian')

@section('content')
    <h2>Edit Pembelian</h2>

    <form action="{{ route('pembelian.update', $pembelian->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="pelanggan_id" class="form-label">Nama Pelanggan</label>
            <select name="pelanggan_id" class="form-select" required>
                @foreach($pelanggans as $pelanggan)
                    <option value="{{ $pelanggan->id }}" {{ $pembelian->pelanggan_id == $pelanggan->id ? 'selected' : '' }}>
                        {{ $pelanggan->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="produk_id" class="form-label">Nama Produk</label>
            <select name="produk_id" class="form-select" required>
                @foreach($produks as $produk)
                    <option value="{{ $produk->id }}" {{ $pembelian->produk_id == $produk->id ? 'selected' : '' }}>
                        {{ $produk->nama_produk }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" name="jumlah" value="{{ $pembelian->jumlah }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('pembelian.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection
