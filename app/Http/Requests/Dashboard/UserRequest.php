<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'lastname' => 'required|string',
            'national_code' => 'required|numeric',
            'phonenumber' => 'required|numeric|digits:10|unique:users,phonenumber,' . $this->user,
            'email' => 'required|email|unique:users,email,' . $this->user,
            'gender' => 'required|boolean',
            'image' => 'required|image|mimes:png,jpg,jpeg,webp|max:1000',
            'password' => 'nullable|string|min:6',
        ];
    }
}
