<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'regex:/^[\pL\s]+$/u', 'min:3', function ($attribute, $value, $fail) {
                if (count(explode(' ', trim($value))) < 2) {
                    $fail('O nome completo (com sobrenome) é obrigatório.');
                }
            }],
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'zip_code' => 'required|digits:8',
            'street_number' => 'required|string',
            'district' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string|size:2',
            'street' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório e deve incluir o sobrenome.',
            'email.required' => 'O email é obrigatório.',
            'email.email' => 'O email deve ser um endereço de email válido.',
            'email.unique' => 'Este email já está em uso.',
            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter no mínimo 8 caracteres.',
            'password.confirmed' => 'A confirmação da senha não confere.',
            'zip_code.required' => 'O CEP é obrigatório.',
            'zip_code.digits' => 'O CEP deve conter exatamente 8 números.',
            'street_number.required' => 'O número do endereço é obrigatório.',
            'district.required' => 'O bairro é obrigatório.',
            'city.required' => 'A cidade é obrigatória.',
            'state.required' => 'O estado é obrigatório.',
            'state.size' => 'O estado deve ter exatamente 2 letras.',
            'street.required' => 'A rua é obrigatória.',
        ];
    }
}
