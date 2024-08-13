<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
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
        if (request()->isMethod('post')) {
            $email = 'unique:users,email';
            $phone = 'unique:users,phone';
        } else {
            $email = Rule::unique('users', 'email')->ignore($this->user);
            $phone = Rule::unique('users', 'phone')->ignore($this->user);
        }

        return [
            'name' => ['required', 'string', 'min:1', 'max:50'],
            'email' => ['required', 'email', $email],
            'community' => ['required', 'string', 'min:2'],
            'pob' => ['required', 'string', 'min:2'],
            'dob' => ['required', 'date'],
            'address' => ['required', 'string', 'min:3', 'max:255'],
            'phone' => ['required', 'numeric', $phone],
            'password' => ['required', 'confirmed', Password::min(5)],
        ];
    }
}
