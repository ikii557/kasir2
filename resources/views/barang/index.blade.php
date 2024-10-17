@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="p-2 mt-4 me-4">
            <h1>Daftar Barang</h1>
            <a href="barang.createbarang" class="btn btn-primary mt-4" >Tambah Barang</a>
                <table class="table table-bordered mt-2">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($barangs as $no=> $barang)
                        <tr>
                                <td>{{ $no +1}}</td>
                                <td>{{ $barang->nama_barang }}</td>
                                <td>{{ $barang->kategori }}</td>
                                <td>{{ $barang->stok }}</td>
                                <td>Rp.{{ $barang->harga_barang }}</td>
                                <td>
                                    <a href="" class="btn btn-warning">Edit</a>
                                    <form action="" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
</div>
</div>
@endsection
