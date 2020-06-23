<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        try {
            return $this->user()->role === 'root';
        } catch (\Throwable $th) {
            return false;
        }
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
            'key' => 'required|min:8|max:16000',
            'role' => 'nullable|in:admin,member'
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
            'key.max' => 'Key cannot be more than 16000 characters',
            'role.in' => 'Role value must be either "admin" or "member", otherwise leave it blank to set it to member'
        ];
    }
}
