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
            'theme'=> ['required', 'string'],
            'title' => ['required', 'string', 'max:255'],
            'professor' => ['required'],
            'ethics_committee' => ['required'],
            'file_pretcc' => ['required', 'mimes:pdf'],
            'term_commitment' => ['required', 'mimes:pdf'],
            'date_claim' => ['required', 'date'],
        ];
    }
}
