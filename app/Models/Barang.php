<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama', 'katagori_id', 'stok', 'harga', 'deskripsi', 'gambar', 'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function katagori()
    {
        return $this->belongsTo(Katagori::class);
    }
}
