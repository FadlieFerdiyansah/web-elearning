<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JadwalRequest extends FormRequest
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
            'kelas_id' => 'required',
            'dosen_id' => 'required',
            'matkul_id' => 'required',
            'hari' => 'required',
            'jam_masuk' => 'required',
            'jam_keluar' => 'required',
        ];
    }
}
