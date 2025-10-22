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
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
            'total_harga' => 'required|integer|min:0',
            'tipe_transaksi' => 'required|string',
            'harga_satuan' => 'required|integer|min:0',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
        ];
    }
}
