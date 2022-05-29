<?php

namespace App\Http\Requests\Manager;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
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
        return [
            // 'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:professors', 'ends_with:@ifsertao-pe.edu.br'],
            // 'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }

    public function messages()
    {
        return [
            'regex' => 'O nome deve conter apenas letras',
            'required' => 'O campo :attribute é obrigatório',
            'max' => 'O campo :attribute deve ter no máximo :max caracteres',
            'unique' => 'O campo :attribute já está cadastrado',
            'email' => 'O campo :attribute deve ser um email válido',
            'email.ends_with' => 'O email deve terminar com "@ifsertao-pe.edu.br"',
            'confimed' => 'As senhas não conferem.'
        ];
    }
}
