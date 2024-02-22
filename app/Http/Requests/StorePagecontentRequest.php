<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePagecontentRequest extends FormRequest
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
            'pagename' => 'required|string',
            'section' => 'required|string',
            'subsection' => 'required|string',
            'heading' => 'required|string',
            'content' => 'required|string',
            'pagetagline' => 'required|string',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'imagealt' => 'required|string',
            'icon' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'iconalt' => 'required|string',
            'headingcontent1' => 'required|string',
            'headingsubcontent1' => 'required|string',
            'headingcontent2' => 'required|string',
            'headingsubcontent2' => 'required|string',
            'headingcontent3' => 'required|string',
            'headingsubcontent3' => 'required|string',
            'headingcontent4' => 'required|string',
            'headingsubcontent4' => 'required|string',
        ];
    }
}
