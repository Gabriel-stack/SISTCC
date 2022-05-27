<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class RequirementRequest extends FormRequest
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
            'photo' => ['required', 'mimes:jpeg,jpg,png'],
            'keywords' => ['required', 'string'],
            'abstract' => ['required', 'string'],
            'type_tcc' => ['required', 'string'],
            'intended_date' => ['required', 'date'],
            'result_ethic_commitee' => ['required', 'mimes:pdf'],
            'proof_article_submission' => ['required', 'mimes:pdf'],
            'consent_advisor' => ['required', 'mimes:pdf'],
            'file_tcc' => ['required', 'mimes:pdf'],
        ];
    }
}
