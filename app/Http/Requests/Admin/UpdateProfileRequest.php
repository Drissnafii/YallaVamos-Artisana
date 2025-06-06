<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore(Auth::id()),
            ],
            'profile_photo' => ['nullable', 'image', 'max:2048'],
            'background_image' => ['nullable', 'image', 'max:4096'], // Allow slightly larger files for background images
        ];

        // The password field is optional, so we will just add the password update rules if the user is changing their password.
        if ($this->filled('password')) {
            $rules['current_password'] = ['required', 'string', Password::defaults()];
            $rules['password'] = ['required', 'string', 'min:8', 'confirmed', 'different:current_password'];
            $rules['password_confirmation'] = ['required'];
        }

        return $rules;
    }

}
