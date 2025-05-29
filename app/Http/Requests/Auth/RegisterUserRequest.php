<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseFormRequest;

// use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //     return true;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'firstName' => 'required|max:255|string',
            'lastName' => 'required|max:255|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'dateOfBirth' => 'required|date',
        ];
    }

    public function messages(): array
    {
        return [
            'firstName.required' => 'First name is required.',
            'firstName.max' => 'First name cannot be longer than 255 characters.',
            'firstName.string' => 'First name must be a string.',

            'lastName.required' => 'Last name is required.',
            'lastName.max' => 'Last name cannot be longer than 255 characters.',
            'lastName.string' => 'Last name must be a string.',

            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already registered.',

            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters',
            'password.confirmed' => 'Passwords do not match.',

            'dateOfBirth.required' => 'Date of birth is required.',
            'dateOfBirth.date' => 'Date of birth must be a valid date.',
        ];
    }
}
