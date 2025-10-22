<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBarangRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nama' => 'required|string|max:255',
            'katagori_id' => 'required|integer|exists:katagoris,id',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'user_id' => 'required|integer|exists:users,id',
        ];
    }
}