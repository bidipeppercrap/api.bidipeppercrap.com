<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class StorePost extends FormRequest
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
            'title' => 'nullable|max:16000',
            'content' => 'nullable|max:16000',
            'display_title' => 'nullable|max:100',
            'display_subtitle' => 'nullable|max:140',
            'thumbnail' => 'nullable|max:16000',
            'pinned' => 'nullable|boolean'
        ];
    }

    public function messages()
    {
        return [
            'title.max' => 'Maximum characters length for Title is 16,000',
            'content.max' => 'Maximum characters length for Content is 16,000',
            'display_title.max' => 'Maximum characters length for Display Title is 100',
            'display_subtitle.max' => 'Maximum characters length for Display Subtitle is 140',
            'thumbnail.max' => 'Maximum characters length for Thumbnail URL is 16,000',
            'pinned.boolean' => 'Pinned value must be a boolean, otherwise just leave it blank to set it to False'
        ];
    }

    /**
     * Failed validation disable redirect
     *
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
