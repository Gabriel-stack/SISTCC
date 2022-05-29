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
            'class' => ['required'],
            'class_code' => ['required'],
            'start_date' => ['required'],
            'end_date' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
        ];
    }
}
