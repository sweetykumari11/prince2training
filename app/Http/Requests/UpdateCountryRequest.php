<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCountryRequest extends FormRequest
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
            'name' => "required|string|unique:countries,name,{$this->id},id,deleted_at,NULL",
            'country_code' => "required|unique:countries,country_code,{$this->id},id,deleted_at,NULL",
            'description' => 'required|string',
            'iso3' => 'required|string',
            'currency' => 'required|string',
            'currency_symbol' => 'required|string',
            'currency_symbol_html' => 'required|string',
            'currency_title' => 'required|string',
            //'flagimage' => 'required|image|max:2048',
        ];
    }
}
