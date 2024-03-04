<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class PasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
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
            'oldPassword' => 'required',
            'newPassword' => 'required|string|min:8|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/',
            'confirmPassword' => 'required|same:newPassword',
        ];
    }
    public function messages()
    {
        return [
            'newPassword.regex' => 'The password must contain at least one letter and one number.',
            'confirmPassword.same' => 'The confirmation password does not match the new password.',
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!$this->isOldPasswordValid()) {
                $validator->errors()->add('oldPassword', 'The old password is incorrect.');
            }
        });
    }

    /**
     * Check if the old password provided matches the one stored in the database.
     *
     * @return bool
     */
    protected function isOldPasswordValid(): bool
    {
        $user = Auth::user();
        return Hash::check($this->input('oldPassword'), $user->password);
    }
}
