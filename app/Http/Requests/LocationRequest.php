<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'country_id' => 'required',
            'region_id' => 'required',
            'address' => 'required',
            'slug' => 'required|string|min:3|max:100',
            'phone' => 'required|regex:/^[0-9]{10}$/',
            'intro' => 'required',
            'image' => 'required|image',
            'description' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keywords' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'phone.regex' => 'The phone number must be exactly 10 digits.',
            'region_id.required' => ' The region field is required. ',
            'country_id.required' => ' The country field is required. '
        ];
    }
}
