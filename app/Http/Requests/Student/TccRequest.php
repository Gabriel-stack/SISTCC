<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class TccRequest extends FormRequest
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
            'theme'=> ['required', 'string', 'min:3', 'max:255'],
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'professor' => ['required', 'numeric','exists:professors,id','regex:/^[0-9]+$/'],
            'ethics_committee' => ['required'],
            'file_pretcc' => ['required', 'mimes:pdf', 'max:4096'],
            'term_commitment' => ['required', 'mimes:pdf', 'max:4096'],
            'date_claim' => ['required', 'date', 'after:today'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'after' => 'O campo :attribute deve ser uma data posterior a hoje.',
        ];
    }
}
