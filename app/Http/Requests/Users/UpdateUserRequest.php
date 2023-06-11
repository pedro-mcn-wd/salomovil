<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
        $regex_name_surnames = "regex:/^[A-ZÁÉÍÓÚÑ][a-záéíóúñ.'-]{1,29}(?: [A-ZÁÉÍÓÚÑ][a-záéíóúñ.'-]{1,29})*?$/";

        return [
            'name' => [$regex_name_surnames, 'max:191', 'nullable'],
            'surname_first' => [$regex_name_surnames, 'max:191', 'nullable'],
            'surname_second' => [$regex_name_surnames, 'max:191', 'nullable'],
            'dni' => ['regex:/^[0-9]{8,8}[A-Za-z]$/','nullable'],
            'birthdate' => ['nullable'],
            'bio' => ['regex:/[\\w\\p{P}\\p{S}]*?/', 'max:500', 'nullable'],
            'avatar' => ['nullable'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->user)],
            'roles' => ['string'],
            'password' => ['confirmed', 'min:8', 'nullable'],
        ];
    }


}
