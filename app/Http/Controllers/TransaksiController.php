<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        // Eager load related barang data
        $transaksis = Transaksi::with('barang')->get();
        return view('transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        // Fetch all available barang for the dropdown
        $barangs = Barang::all();
        return view('transaksi.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        // Validate the transaction data
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jumlah_barang' => 'required|numeric|min:1', // Fixed typo (jumlah_barang instead of jumblah_barang)
            'total_harga' => 'required|numeric',
            'metode_pembayaran' => 'required|in:cash,credit,debit',
        ]);

        // Find the barang (product) by its ID
        $barang = Barang::findOrFail($request->barang_id);

        // Ensure sufficient stock is available
        if ($barang->stok < $request->jumlah_barang) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi.');
        }

        // Calculate the total price based on the product's price and the quantity
        $total_harga = $request->jumlah_barang * $barang->harga_barang;

        // Create a new transaction with the valid data
        Transaksi::create([
            'barang_id' => $request->barang_id,
            'jumlah_barang' => $request->jumlah_barang, // Corrected the key
            'total_harga' => $request->$total_harga,
            'metode_pembayaran' => $request->metode_pembayaran,
        ]);

        // Reduce the stock of the barang (item)
        $barang->decrement('stok', $request->jumlah_barang);

        // Redirect back to the transaction list with a success message
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }
}
