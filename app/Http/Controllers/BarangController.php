<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();
        return view('/barang.index', compact('barangs'));
    }

    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'kategori' => 'required|in:makanan ringan,makanan berat',
            'stok' => 'required|numeric',
            'harga_barang' => 'required|numeric',
        ]);

        Barang::create($request->all());
        return redirect()->route('/barang.index')->with('success', 'Barang berhasil ditambahkan');
    }

    public function edit(Barang $barang)
    {
        return view('/barang', compact('barang'));
    }

    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama_barang' => 'required',
            'kategori' => 'required|in:makanan ringan,makanan berat',
            'stok' => 'required|numeric',
            'harga_barang' => 'required|numeric',
        ]);

        $barang->update($request->all());
        return redirect()->route('barang')->with('success', 'Barang berhasil diupdate');
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('barang')->with('success', 'Barang berhasil dihapus');
    }
}
