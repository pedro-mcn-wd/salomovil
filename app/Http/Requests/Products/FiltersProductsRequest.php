<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class FiltersProductsRequest extends FormRequest
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
            'name' => ['nullable'],
            'description' => ['nullable'],
            'category' => ['nullable'],
            'subcategory' => ['nullable'],
            'min_stock' => ['nullable'],
            'max_stock' => ['nullable'],
            'min_price' => ['nullable'],
            'max_price' => ['nullable'],
            'sort_in_order' => ['nullable','required_with:sort_by_field'],
            'sort_by_field' => ['nullable','required_with:sort_in_order'],
        ];
    }
}
