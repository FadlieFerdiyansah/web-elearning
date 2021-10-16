<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        if(request('tipe') == 'pdf'){
            if (request()->routeIs('materis.update',encrypt($this->materiId))) {
                if (request('file_or_link')) {
                    $condition = 'file|mimes:pdf|max:1000'; 
                }else{
                    $condition = '';
                }
            }else{
                $condition = 'file|mimes:pdf|max:1000';
            }
        }else{
            $condition = 'required';
        }
        return [
            'kelas_id' => 'required',
            'matkul_id' => 'required',
            'judul' => 'required',
            'pertemuan' => 'required',
            'tipe' => 'required',
            'file_or_link' => $condition,
            'deskripsi' => 'required',
        ];
    }
}
