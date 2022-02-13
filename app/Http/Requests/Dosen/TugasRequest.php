<?php

namespace App\Http\Requests\Dosen;

use Illuminate\Foundation\Http\FormRequest;

class TugasRequest extends FormRequest
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
        if(request('tipe') == 'file'){
            if (request()->routeIs('tugas.update',$this->id)) {
                if (request('file_or_link')) {
                    $condition = 'file|mimes:ppt,pptx,pdf,doc,docx,xls,xlsx|max:10000'; 
                }else{
                    $condition = '';
                }
            }else{
                $condition = 'file|mimes:ppt,pptx,pdf,doc,docx,xls,xlsx|max:10000';
            }
        }else{
            $condition = 'required';
        }

        return [
            'judul' => 'required',
            'tipe' => 'required',
            'file_or_link' => $condition,
            'pertemuan' => 'required',
            'deskripsi' => 'required',
            'pengumpulan' => 'required',
        ];
    }
}
