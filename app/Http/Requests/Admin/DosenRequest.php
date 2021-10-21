<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'nip' => 'required|unique:dosens,nip,'. optional($this->dosen)->id,
            'nama' => 'required',
            'email' => 'required|unique:dosens,email,'. optional($this->dosen)->id,
            'password' => Rule::requiredIf(request()->routeIs('dosens.store')),
            'matkul' => 'required|array',
            'kelas' => 'required|array'
        ];
    }
}
