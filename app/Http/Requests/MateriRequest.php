<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MateriRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'kelas' => 'required',
            'matkul' => 'required',
            'judul' => 'required',
            'pertemuan' => 'required',
            'tipe' => 'required',
            'file_or_link' => 'required',
            'deskripsi' => 'required',
        ];
    }
}
