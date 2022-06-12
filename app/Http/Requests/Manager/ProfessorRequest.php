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
            'name' => ['required'],
            'email' => ['required'],
            'phone' => ['required'],
            'titration' => ['required'],
            'organ' => ['required'],
            'Cpf' => ['required', 'digits:11', 'unique:professors'],
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
