<?php

namespace App\Http\Requests\Student;

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
            'name' => ['required', 'string', 'min:3','max:255', 'regex:/^[a-zA-Z ]+$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:students', 'ends_with:@aluno.ifsertao-pe.edu.br,@ifsertao-pe.edu.br'],
            'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
            'phone' => ['required', 'string', 'min:12', 'max:15'],
            'registration' => ['required', 'string', 'max:20', 'regex:/^[0-9]+$/'],
            'state' => ['required', 'string', 'min:2', 'max:2'],
            'city' => ['required', 'string', 'min:3', 'max:100'],
            'historic' => ['required', 'mimes:pdf', 'max:4096'],
            'district' => ['required', 'string', 'min:3', 'max:100'],
            'street' => ['required', 'string', 'min:3','max:200'],
            'zip_code' => ['required', 'string', 'min:8', 'max:9'],
        ];
    }

    public function messages()
    {
        return [
            'name.regex' => 'O nome deve conter apenas letras',
            'required' => 'O campo :attribute é obrigatório',
            'max' => 'O campo :attribute deve ter no máximo :max caracteres',
            'unique' => 'O campo email já está cadastrado',
            'email' => 'O campo :attribute deve ser um email válido',
            'email.ends_with' => 'O email deve terminar com "@aluno.ifsertao-pe.edu.br"',
            'confimed' => 'As senhas não conferem.',
            'phone.regex' => 'O campo telefone deve conter apenas números',
            'password.min' => 'A senha deve ter no mínimo 8 caracteres',
            'password.letters' => 'A senha deve conter letras',
            'password.numbers' => 'A senha deve conter números',
        ];
    }
}
