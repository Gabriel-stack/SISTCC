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
            'abstract' => ['required', 'string', 'max:600'],
            'type_tcc' => ['required', 'in:artigo,cap_livro, monografia,outro'],
            'intended_date' => ['required', 'date', 'after:today'],
            'result_ethic_commitee' => ['file', 'mimes:pdf', 'max:4096'],
            'proof_article_submission' => ['required_if:type_tcc,artigo', 'mimes:pdf', 'max:4096'],
            'consent_professor' => ['required', 'mimes:pdf', 'max:4096'],
            'file_tcc' => ['required', 'mimes:pdf', 'max:4096'],
            'members.one.*' => ['required'],
            'members.one.accept_member' => ['required', 'file', 'mimes:pdf', 'max:4096'],
            'members.two.*' => ['required'],
            'members.two.accept_member' => ['required', 'file', 'mimes:pdf', 'max:4096'],
            'members.one.cpf' => ['numeric', 'digits:11'],
            'members.two.cpf' => ['numeric','digits:11'],
            'members.three.name' => ['required_with:members.three.cpf', 'required_with:members.three.titration', 'required_with:members.three.organ', 'required_with:members.three.accept_member'],
            'members.three.cpf' => ['required_with:members.three.name', 'required_with:members.three.titration', 'required_with:members.three.organ', 'required_with:members.three.accept_member', 'numeric', 'digits:11'],
            'members.three.titration' => ['required_with:members.three.name', 'required_with:members.three.cpf', 'required_with:members.three.organ', 'required_with:members.three.accept_member'],
            'members.three.organ' => ['required_with:members.three.name', 'required_with:members.three.cpf', 'required_with:members.three.titration', 'required_with:members.three.accept_member'],
            'members.three.accept_member' => ['required_with:members.three.name', 'required_with:members.three.cpf', 'required_with:members.three.titration', 'required_with:members.three.organ'],
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
