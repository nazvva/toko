<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Detail Pelanggan</h1>

    <h3>{{ $pelanggan->nama_pelanggan }}</h3>
    <p>Alamat: {{ $pelanggan->alamat }}</p>

    <h4>Tambah Pembelian</h4>
    <form action="{{ route('pelanggan.tambahPembelian', $pelanggan->id_pelanggan) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="id_produk" class="form-label">Produk</label>
            <select name="id_produk" class="form-control" required>
                @foreach($produks as $produk)
                    <option value="{{ $produk->id_produk }}">{{ $produk->nama_produk }} (Rp{{ number_format($produk->harga_produk, 0, ',', '.') }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" name="jumlah" class="form-control" required min="1">
        </div>
        <button type="submit" class="btn btn-primary">Beli Produk</button>
    </form>

    <h4 class="mt-4">Riwayat Pembelian</h4>
    <ul class="list-group">
        @foreach($pelanggan->pembelians as $pembelian)
            <li class="list-group-item">
                {{ $pembelian->produk->nama_produk }} - {{ $pembelian->jumlah }} pcs
            </li>
        @endforeach
    </ul>

    <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
</body>
</html>
