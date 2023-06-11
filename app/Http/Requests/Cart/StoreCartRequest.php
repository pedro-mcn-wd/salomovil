<?php

namespace App\Http\Requests\Cart;

use Illuminate\Foundation\Http\FormRequest;

class StoreCartRequest extends FormRequest
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
        $regex = "regex:/^[A-Za-z\s]+$/";

        return [
            'delivery_address' => ['required','string','max:255'],
            'billing_address' => ['required','string','max:255'],
            'cc_number' => ['required','numeric', 'min_digits:14', 'max_digits:16'],
            'cc_expiry_date' => ['required', 'date'],
            'cvc_cvv' => ['required','numeric', 'digits:3'],
            'card_holder' => ['required', $regex, 'max:191'],
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
            'delivery_address.required' => 'Debe especificar una dirección de envío.',
            'billing_address.required' => 'Debe especificar una dirección de facturación.',

            'cc_number.required' => 'Debe especificar una dirección de facturación.',
            'cc_number.numeric' => 'El numero de cuenta solo admite valores numéricos.',
            'cc_number.min_digits' => 'El numero de cuenta no admite menos de 14 cifras.',
            'cc_number.max_digits' => 'El numero de cuenta no admite más de 16 cifras.',

            'cc_expiry_date.required' => 'Debe especificar una fecha de expiración.',
            'cc_expiry_date.date' => 'La fecha de expiración debe tener un formato válido.',

            'cvc_cvv.required' => 'Debe especificar el CVC / CVV.',
            'cvc_cvv.numeric' => 'El CVC / CVV solo admite valores numéricos',
            'cvc_cvv.digits' => 'El CVC / CVV debe contener 3 cifras.',

            'card_holder.required' => 'Debe especificar el titular de la tarjeta.',
            'card_holder.regex' => 'El nombre del titular de la tarjeta debe tener un formato válido.',
        ];
    }
}
