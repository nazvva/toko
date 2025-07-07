@extends('layouts.app') {{-- Asumsikan Anda menggunakan layout default Laravel --}}

@section('title', 'Tambah Pembelian Baru')

@section('content')
<div class="container">
    <h2>Tambah Pembelian Baru</h2>

    <div class="mb-3">
        <a href="{{ route('pembelian.index') }}" class="btn btn-secondary">Kembali ke Daftar Pembelian</a>
    </div>

    <div class="card p-4">
        <form action="{{ route('pembelian.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="pelanggan_id" class="form-label">Nama Pelanggan</label>
                <select name="pelanggan_id" class="form-control @error('pelanggan_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Pelanggan --</option>
                    @foreach($pelanggans as $pelanggan)
                        <option value="{{ $pelanggan->id }}" {{ old('pelanggan_id') == $pelanggan->id ? 'selected' : '' }}>{{ $pelanggan->nama }}</option>
                    @endforeach
                </select>
                @error('pelanggan_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="produk_id" class="form-label">Nama Produk</label>
                <select name="produk_id" class="form-control @error('produk_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Produk --</option>
                    @foreach($produks as $produk)
                        <option value="{{ $produk->id }}" {{ old('produk_id') == $produk->id ? 'selected' : '' }}>{{ $produk->nama_produk }} (Rp {{ number_format($produk->harga, 0, ',', '.') }})</option>
                    @endforeach
                </select>
                @error('produk_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah Beli</label>
                <input type="number" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror" min="1" value="{{ old('jumlah') }}" required>
                @error('jumlah')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Total harga akan dihitung otomatis di backend --}}

            <button type="submit" class="btn btn-success">Simpan Pembelian</button>
        </form>
    </div>
</div>
@endsection