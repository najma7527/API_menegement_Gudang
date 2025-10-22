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
            'nama' => 'sometimes|required|string|max:255',
            'katagori_id' => 'sometimes|required|exists:katagoris,id',
            'stok' => 'sometimes|required|integer|min:0',
            'harga' => 'sometimes|required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'user_id' => 'sometimes|required|exists:users,id',
        ];
    }
}
