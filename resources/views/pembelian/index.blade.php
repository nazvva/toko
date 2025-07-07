@extends('welcome')

@section('title', 'Daftar Pembelian')

@section('content')
<div class="container">
    <h2>Daftar Pembelian</h2>

    <div class="mb-3">
        <a href="{{ route('pembelian.create') }}" class="btn btn-primary">Tambah Pembelian Baru</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>Nama Produk</th>
                <th>Harga Satuan</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Tanggal Pembelian</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pembelian as $item)
                <tr>
                    <td>{{ $loop->iteration + ($pembelian->currentPage() - 1) * $pembelian->perPage() }}</td>
                    <td>{{ $item->pelanggan->nama }}</td>
                    <td>{{ $item->produk->nama_produk }}</td>
                    <td>Rp {{ number_format($item->produk->harga, 0, ',', '.') }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                    <td>{{ $item->created_at->format('d-m-Y H:i') }}</td>
                    <td>
                        <form action="{{ route('pembelian.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin ingin hapus pembelian ini?')" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Belum ada data pembelian</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $pembelian->links() }}
</div>
@endsection

2. resources/views/pembelian/create.blade.php:

@extends('welcome')

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

            <button type="submit" class="btn btn-success">Simpan Pembelian</button>
        </form>
    </div>
</div>
@endsection
