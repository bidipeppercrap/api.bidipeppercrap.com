<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProject extends FormRequest
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
            'title' => 'required|max:100|unique:projects',
            'description' => 'nullable|max:280',
            'thumbnail' => 'nullable|max:16000',
            'link' => 'nullable|max:16000',
            'show_title' => 'nullable|boolean',
            'order' => 'nullable|date'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Please specify a title',
            'title.max' => 'Maximum characters for title is 100',
            'title.unique' => 'Title must be unique',
            'description.max' => 'Maximum characters for description is 280',
            'thumbnail.max' => 'Thumbnail url is too long',
            'link.max' => 'Link url is too long',
            'show_title.boolean' => 'Show Title must be boolean, otherwise leave it blank to set it to True',
            'order.date' => 'Order must be a date, otherwise leave it blank to set it to current date'
        ];
    }
}
