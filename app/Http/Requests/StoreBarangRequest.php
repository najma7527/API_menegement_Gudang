<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBarangRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nama' => 'required|string|max:255',
            'katagori_id' => 'required|exists:katagoris,id',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|integer|min:0',
        ];
    }
}
