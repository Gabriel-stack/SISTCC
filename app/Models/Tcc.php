<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tcc extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'advisor_id',
        'subject_id',
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
        'consent_advisor',
        'file_tcc',
        'members',
    ];


    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function advisor()
    {
        return $this->belongsTo(Advisor::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
