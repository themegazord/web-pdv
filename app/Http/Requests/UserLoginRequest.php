<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|max:255',
            'password' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo é obrigatório',
            'string' => 'O campo é somente para caracteres alfanuméricos',
            'max' => 'O campo aceita no máximo 255 caracteres',
            'email' => 'O email é inválido',
        ];
    }
}
