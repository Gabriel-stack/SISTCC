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
            'photo' => ['required','mimes:jpeg,jpg,png'],
            'keywords' => ['required', 'string'],
            'abstract' => ['required', 'string'],
            'type_tcc' => ['required', 'in:artigo,cap_livro, monografia,outro'],
            'intended_date' => ['required', 'date', 'after:today'],
            'result_ethic_commitee' => ['file', 'mimes:pdf'],
            'proof_article_submission' => ['required_if:type_tcc,artigo', 'mimes:pdf'],
            'consent_professor' => ['required', 'mimes:pdf'],
            'file_tcc' => ['required', 'mimes:pdf'],
            'members.one.*' => ['required'],
            'members.one.accept_member' => ['required', 'file', 'mimes:pdf'],
            'members.two.*' => ['required'],
            'members.two.accept_member' => ['required', 'file', 'mimes:pdf'],
            'members.one.cpf' => ['numeric', 'digits:11'],
            'members.two.cpf' => ['numeric','digits:11'],
            'members.three.name' => ['required_with:members.three.cpf, members.three.titration, members.three.organ'],
            'members.three.cpf' => ['required_with:members.three.name, members.three.titration, members.three.organ', 'numeric', 'digits:11'],
            'members.three.titration' => ['required_with:members.three.name, members.three.cpf, members.three.organ'],
            'members.three.organ' => ['required_with:members.three.name, members.three.cpf, members.three.titration'],
            'members.three.accept_member' => ['sometimes','required'],
        ];
    }
    public function messages()
    {
        return [
            'after:today' => 'A data deve ser posterior a hoje',
            // 'required_with' => 'O campo :attribute é obrigatório quando o campo qualquer outro valor do membro 3 está preenchido',
        ];
  }
}
