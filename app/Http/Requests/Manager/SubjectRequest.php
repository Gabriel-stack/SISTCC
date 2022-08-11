<?php

namespace App\Http\Requests\Manager;

use Illuminate\Foundation\Http\FormRequest;

class SubjectRequest extends FormRequest
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
            'class' => ['required', 'unique:subjects,class'],
            'class_code' => ['required'],
            'start_date' => ['required', 'after:yesterday'],
            'end_date' => ['required', 'after:start_date, +3 months'],
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'unique' => 'O campo nome da turma já foi utilizado em turmas anteriormente',
        ];
    }
}
