<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTransaksiRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'barang_id' => 'sometimes|required|exists:barangs,id',
            'jumlah' => 'sometimes|required|integer|min:1',
            'total_harga' => 'sometimes|required|integer|min:0',
            'tipe_transaksi' => 'sometimes|required|in:masuk,keluar',
            'harga_satuan' => 'sometimes|required|numeric|min:0',
            'tanggal' => 'sometimes|required|date',
            'keterangan' => 'nullable|string',
            'user_id' => 'sometimes|required|exists:users,id',
        ];
    }
}
