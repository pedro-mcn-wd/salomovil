<?php

namespace App\Http\Requests\Subcategories;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSubcategoryRequest extends FormRequest
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
        $regex = "regex:/^[A-ZÑÁÉÍÓÚ][\w\p{P}\p{S}]*?/";

        return [
            'name' => ['required', $regex, 'max:191', Rule::unique('subcategories', 'name')->ignore($this->subcategory)],
            'code' => ['required', 'max:10', Rule::unique('subcategories', 'code')->ignore($this->subcategory)],
            'description' => ['required', $regex, 'max:500'],
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
            'name.unique' => 'Ya existe una categoría con ese código.',

            'description.required' => 'Debe especificar una descripción.',
        ];
    }
}
