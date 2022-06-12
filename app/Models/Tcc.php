<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tcc extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'subject_id',
        'professor_id',
        'coprofessor_id',
        'situation',
        'stage',
        'theme',
        'title',
        'ethics_committee',
        'term_commitment',
        'date_claim',
        'photo',
        'keywords',
        'abstract',
        'type_tcc',
        'intended_date',
        'result_ethic_committee',
        'proof_article_submission',
        'consent_professor',
        'file_pretcc',
        'file_tcc',
        'final_tcc',
        'deposit_statement',
        'members',
    ];

    protected function title(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => strtoupper($value),
        );
    }
    protected function theme(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => strtoupper($value),
        );
    }
    public function professor()
    {
        return $this->belongsTo(Professor::class);
    }
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
