<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;
    protected $fillable = [
        'barang_id', 'jumlah', 'total_harga', 'tipe_transaksi', 'harga_satuan', 'tanggal', 'keterangan', 'user_id'
    ];
    //
}
