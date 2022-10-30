<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class locationEdit extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'img' => ['nullable', 'image'],
        ];
    }

    public function messages()
    {
        /// error messages
        return [
            'name.required' => __('validation.required'),
            'img.image' => __('validation.image'),
        ];
    }
}
