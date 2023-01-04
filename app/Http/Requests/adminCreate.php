<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class adminCreate extends FormRequest
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
            'password' => ['required', 'string', 'max:8'],
            'gender' => 'required|in:male,female',
        ];
    }

    public function messages()
    {
        /// error messages
        return [
            'name.required' => __('validation.required'),
            'password.required' => __('validation.required'),
            'name.string' => __('validation.string'),
        ];
    }
}
