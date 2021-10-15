<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonRequest extends FormRequest
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

    public function validationData(): array
    {
        $input = parent::validationData();
        return $input;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $input = parent::validationData();
        return [
            'organization_id' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'email' => ['required','email'],
            'avatar'  => 'mimes:jpg,jpeg,png', 
        ];
    }

    public function messages()
    {
        return [
            'organization_id.required' => 'Organisasi Harus Diisi',
            'name.required' => 'Nama Harus Diisi',
            'phone.required' => 'Phone Harus Diisi',
            'email.required' => 'Email Harus Diisi',
            'name.email' => 'Email harus valid',
            'avatar.mimes' => 'Ekstensi file harus berupa jpg, jpeg, png',
        ];
    }
}