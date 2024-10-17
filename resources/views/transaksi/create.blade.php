@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tambah Transaksi Baru</h2>

        <div class="card">
            <div class="p-3 mt-4 me-4">
                <!-- Specify the correct form action for transaction submission -->
                <form action="transaksi.store" method="POST">
                    @csrf

                    <!-- Nama Barang -->
                    <div class="form-group">
                        <label for="barang_id">Nama Barang:</label>
                        <select name="barang_id" id="barang_id" class="form-control" required>
                            <option value="" disabled selected>Pilih Barang</option>
                            <!-- Loop through the $barangs variable to display item names -->
                            @foreach ($barangs as $barang)
                                <option {{ old('barang_id') == $barang->id ? 'selected' : '' }} value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Jumlah Barang -->
                    <div class="form-group">
                        <label for="jumlah_barang">Jumlah Barang:</label>
                        <input type="number" value="{{ old('jumlah_barang') }}" name="jumlah_barang" id="jumlah_barang" class="form-control" required>
                    </div>

                    <!-- Total Harga -->
                    <div class="form-group">
                        <label for="total_harga">Total Harga(Rp):</label>
                        <input type="number" value="{{ old('total_harga') }}" name="total_harga" id="total_harga" class="form-control" required>
                    </div>

                    <!-- Metode Pembayaran -->
                    <div class="form-group">
                        <label for="metode_pembayaran">Metode Pembayaran:</label>
                        <select name="metode_pembayaran" id="metode_pembayaran" class="form-control" required>
                            <option value="" disabled selected>Pilih Metode Pembayaran</option>
                            @foreach ($transaksis as $transaksi )
                                <option {{old('metode_pembayaran') ==$transaksi->metode_pembayaran?'selected':''}} value="{{$metode_pembayaran->transaksi}}">{{$transaksi->metode_pembayaran}}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary">Tambah Transaksi</button>
                </form>
            </div>
        </div>
    </div>
@endsection
