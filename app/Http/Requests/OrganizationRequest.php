<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationRequest extends FormRequest
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
            'name' => 'required',
            'phone' => 'required',
            'email' => ['required','email'],
            'website' => 'required',
            'logo'  => 'mimes:jpg,jpeg,png', 
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama Harus Diisi',
            'phone.required' => 'Phone Harus Diisi',
            'email.required' => 'Email Harus Diisi',
            'name.email' => 'Email harus valid',
            'website.required' => 'Website Harus Diisi',
            'logo.mimes' => 'Ekstensi file harus berupa jpg, jpeg, png',
        ];
    }
}