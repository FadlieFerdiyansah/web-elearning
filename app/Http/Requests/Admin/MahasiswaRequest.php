<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MahasiswaRequest extends FormRequest
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
            'nim' => 'required|unique:dosens,nip',
            'nama' => 'required',
            'email' => 'required|unique:dosens,email',
            'fakultas' => 'required',
            'kelas' => 'required',
            'password' => 'required'
        ];
    }
}
