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
        ];
    }
}
