<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'birthdate' => ['nullable', 'date'],
            'bio' => ['regex:/[\\w\\p{P}\\p{S}]*?/', 'max:500', 'nullable'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'roles' => ['string'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.*' => 'Debe especificar un nombre válido.',
            'surname_first.*' => 'Debe especificar un nombre válido.',
            'surname_second.*' => 'Debe especificar un nombre válido.',
            'dni.*' => 'Debe especificar un formato de dni válido.',
            'birthdate.*' => 'Debe especificar un formato de fecha válido.',
            'bio.*' => 'Debe especificar un formato de biografía válido.',

            'email.required' => 'Debe especificar un email.',
            'email.email' => 'Debe especificar un formato de email válido.',
        ];
    }
}
