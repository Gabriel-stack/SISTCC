<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tcc extends Model
{
    use HasFactory;

    protected $fillable = [
        'professor_id',
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
        'consent_advisor',
        'file_tcc',
        'members',
    ];



    public function professor()
    {
        return $this->belongsTo(Manager::class);
    }
    public function students()
    {
        return $this->hasMany(StudentHistory::class);
    }
}
