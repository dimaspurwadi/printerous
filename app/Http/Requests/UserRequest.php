<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\User\UserExists;

class UserRequest extends FormRequest
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
        $input = parent::validationData();
        return [
            'name' => 'required',
            'email' => 'required',
            'new_password'  => 'confirmed',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is Required!',
            'username.required' => 'Username is Required!',
            'email.required' => 'Email is Required!',
            'new_password.confirmed' => 'Konfirmasi Password tidak cocok.',
        ];
    }
}