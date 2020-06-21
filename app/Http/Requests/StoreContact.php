<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContact extends FormRequest
{
    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        //
    }

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
            'title' => ['required', 'max:100', \Illuminate\Validation\Rule::unique('contacts')->ignore($this->contact->id)],
            'icon' => 'required|max:16000',
            'link' => 'required|max:16000',
            'order' => 'nullable|date'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Please specify a title for this contact',
            'title.max' => 'Maximum characters for title is 16,000',
            'title.unique' => 'Title must be unique',
            'icon.required' => 'Please specify an icon url',
            'icon.max' => 'Icon url is too long',
            'link.required' => 'Please specify an link url',
            'link.max' => 'Link url is too long',
            'order.date' => 'Order must be a date'
        ];
    }
}
