<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class userCreate extends FormRequest
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
            'location_id' => ['required','exists:locations,id'],
            'gender' => 'required|in:male,female',
        ];
    }

    public function messages()
    {
        /// error messages
        return [
            'name.required' => __('validation.required'),
            'name.string' => __('validation.string'),
            'location_id.required' => __('validation.required'),

        ];
    }
}
