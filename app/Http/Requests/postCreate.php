<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class postCreate extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'status' => ['required', 'string'],
            'img' => ['required', 'image'],
        ];
    }

    public function messages()
    {
        /// error messages
        return [
            'title.required' => __('validation.required'),
            'title.string' => __('validation.string'),
            'category_id.required' => __('validation.required'),
            'name_en.string' => __('validation.string'),
            'description.required' => __('validation.required'),
            'status.required' => __('validation.required'),
            'img.required' => __('validation.required'),
            'img.image' => __('validation.image'),
        ];
    }
}
