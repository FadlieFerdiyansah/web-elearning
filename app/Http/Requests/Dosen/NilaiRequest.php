<?php

namespace App\Http\Requests\Dosen;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NilaiRequest extends FormRequest
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
            'komentar_dosen' => [Rule::requiredIf($this->tugas)],
            'nilai' => ['numeric', 'min:0', 'max:100', Rule::requiredIf($this->tugas)],
        ];
    }
}
