<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'name' => 'nullable|min:3',
            'email' => 'nullable|email',
            'password' => 'nullable',
            'rule' => 'nullable',
            'password_confirmation'  => 'nullable|min:6|required_with:password_confirmation|same:password_confirmation'
        ];
    }
}
