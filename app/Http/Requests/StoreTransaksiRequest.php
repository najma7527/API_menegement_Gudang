<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransaksiRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'barang_id' => 'required|integer|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
            'total_harga' => 'required|numeric|min:0',
            'tipe_transaksi' => 'required|in:masuk,keluar',
            'harga_satuan' => 'required|numeric|min:0',
            'tanggal' => 'required|date',
            'user_id' => 'required|integer|exists:users,id',
        ];
    }
}