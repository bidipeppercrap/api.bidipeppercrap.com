<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;

class RegisterRoot extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $users = User::all();

        return !count($users);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'identity' => 'required|max:100|unique:users',
            'key' => 'required|min:8|max:16000'
        ];
    }

    public function messages()
    {
        return [
            'identity.required' => 'Identity is required',
            'identity.max' => 'Identity cannot be more than 100 characters',
            'identity.unique' => 'Identity must be unique',
            'key.required' => 'Key is required',
            'key.min' => 'Key must be at least 8 characters',
            'key.max' => 'Key cannot be more than 16000 characters'
        ];
    }
}
