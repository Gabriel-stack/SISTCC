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
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z ]+$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:students', 'ends_with:@aluno.ifsertao-pe.edu.br,@ifsertao-pe.edu.br'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'phone' => ['required', 'string', 'max:12', 'regex:/^[0-9]+$/'],
            'registration' => ['required', 'string', 'max:20', 'regex:/^[0-9]+$/'],
            'state' => ['required', 'string', 'max:2'],
            'city' => ['required', 'string', 'max:255'],
            'historic' => ['required','mimes:pdf'],
            'district' => ['required', 'string', 'max:255'],
            'street' => ['required', 'string', 'max:255'],
            'zip_code' => ['required', 'string', 'max:255'],
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
        ];
    }
}
