<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['nullable'],
            'subcategory_id' => ['nullable'],
            'description' => ['nullable', 'string'],
            'stock' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
            'images_products' => ['nullable'],
            'images_products.*' => ['nullable', 'mimes:jpg,jpeg,webp,png'],
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

            'stock.required' => 'Debe especificar el stock.',
            'stock.numeric' => 'El stock debe ser numérico.',

            'price.required' => 'Debe especificar el precio.',
            'price.numeric' => 'El precio debe ser numérico.',

            'images_products.*.mimes' => 'Las imagenes deben tener un formato válido.',
        ];
    }
}
