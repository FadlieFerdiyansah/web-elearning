<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DosenRequest extends FormRequest
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
            'nip' => 'required|unique:dosens',
            'nama' => 'required',
            'email' => 'required|unique:dosens',
            'password' => 'required',
            'matkul' => 'required|array',
            'kelas' => 'required|array'
        ];
    }
}
