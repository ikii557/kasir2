<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = ['barang_id', 'jumlah_barang', 'total_harga', 'metode_pembayaran'];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}

