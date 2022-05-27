<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'class',
        'class_code',
        'start_date',
        'end_date',
        'situation',
    ];

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function studentHistories()
    {
        return $this->belongsToMany(StudentHistory::class);
    }


}
