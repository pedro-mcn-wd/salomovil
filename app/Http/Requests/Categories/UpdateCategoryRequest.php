<?php

namespace App\Http\Requests\Categories;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
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
        $regex = "regex:/^[A-ZÁÉÍÓÚÑ][a-záéíóúñ.'-]{1,29}(?: [A-ZÁÉÍÓÚÑ][a-záéíóúñ.'-]{1,29})*?$/";

        return [
            'name' => ['required', $regex, 'max:191', Rule::unique('categories', 'name')->ignore($this->category)],
            'code' => ['required', 'max:10', Rule::unique('categories', 'code')->ignore($this->category)],
            'description' => ['required', 'regex:/[\\w\\p{P}\\p{S}]*?/', 'max:500'],
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
            'name.required' => 'Debe especificar un nombre.',
            'name.unique' => 'Ya existe una categoría con ese nombre.',

            'code.required' => 'Debe especificar un código.',
            'code.unique' => 'Ya existe una categoría con ese código.',

            'description.required' => 'Debe especificar una descripción.',
        ];
    }
}
