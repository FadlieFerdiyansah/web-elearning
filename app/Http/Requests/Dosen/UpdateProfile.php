<?php

namespace App\Http\Requests\Dosen;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfile extends FormRequest
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
            // password saat ini
            'password_saat_ini' => ['required', function ($attribute, $value, $fail) {
                if (!Hash::check($value, auth()->user()->password)) {
                    return $fail('Password saat ini tidak sesuai');
                }
            }],
            'password' => ['required','confirmed'],
        ];
    }

    public function messages()
    {
        return [
            'password_saat_ini.required' => 'Password saat ini tidak boleh kosong',
            'password.required' => 'Password baru tidak boleh kosong',
            'password.confirmed' => 'Password baru tidak sama dengan konfirmasi password',
        ];
    }
}
