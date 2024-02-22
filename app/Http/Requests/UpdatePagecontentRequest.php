<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePageContentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Add authorization logic here if needed
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
            'page_name' => 'required|string|max:255',
            'section' => 'required|string|max:255',
            'subsection' => 'required|string|max:255',
            'heading' => 'required|string|max:255',
            'content' => 'required|string',
            'pagetagline' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust max file size as needed
            'image_alt' => 'nullable|string|max:255',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust max file size as needed
            'icon_alt' => 'nullable|string|max:255',
            'headingcontent1' => 'required|string|max:255',
            'headingsubcontent1' => 'required|string|max:255',
            'headingcontent2' => 'required|string|max:255',
            'headingsubcontent2' => 'required|string|max:255',
            'headingcontent3' => 'required|string|max:255',
            'headingsubcontent3' => 'required|string|max:255', // Added validation rule for headingsubcontents3
            'headingcontent4' => 'required|string|max:255',
            'headingsubcontent4' => 'required|string|max:255',
        ];
    }
}
