<?php

namespace App\Http\Requests\Manager;

use Illuminate\Foundation\Http\FormRequest;

class ProfessorRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:professors', 'ends_with:@ifsertao-pe.edu.br'],
            'phone' => ['required', 'string', 'min:12', 'max:15'],
            'titration' => ['required', 'string'],
            'organ' => ['required', 'string'],
            'cpf' => ['required', 'string', 'min:14', 'max:14', 'unique:professors'],
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'unique' => 'O :attribute já está cadastrado',
            'digits' => 'O :attribute deve conter 11 dígitos',
        ];
    }
}
