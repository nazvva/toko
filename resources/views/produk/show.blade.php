<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Detail Produk</h1>

        <div class="card mb-4">
            <div class="card-body">
                <h2 class="card-title">{{ $produk->nama_produk }}</h2>
                <p class="card-text">Harga: Rp{{ number_format($produk->harga, 0, ',', '.') }}</p>
            </div>
        </div>

        <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
