@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Barang</h2>

    <!-- Form to create a new barang -->
    <form action="barang.store" method="post">
        @csrf

        <!-- Nama Barang -->
        <div class="form-group">
            <label for="nama_barang">Nama Barang:</label>
            <input type="text" name="nama_barang" id="nama_barang" class="form-control" value="{{ old('nama_barang') }}" required>
        </div>

        <!-- Kategori -->
        <div class="form-group">
            <label for="kategori">Kategori:</label>
            <select name="kategori" id="kategori" class="form-control" required>
                <option value="" disabled selected>Pilih Kategori</option>
                <option value="makanan ringan" {{ old('kategori') == 'makanan ringan' ? 'selected' : '' }}>Makanan Ringan</option>
                <option value="makanan berat" {{ old('kategori') == 'makanan berat' ? 'selected' : '' }}>Makanan Berat</option>
            </select>
        </div>

        <!-- Stok -->
        <div class="form-group">
            <label for="stok">Jumlah Stok:</label>
            <input type="number" name="stok" id="stok" class="form-control" value="{{ old('stok') }}" required>
        </div>

        <!-- Harga Barang -->
        <div class="form-group">
            <label for="harga_barang">Harga Barang (Rp):</label>
            <input type="number" name="harga_barang" id="harga_barang" class="form-control" value="{{ old('harga_barang') }}" step="0.01" required>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary mt-3">Tambah Barang</button>
    </form>
</div>
@endsection
