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
        'manager_id',
        'class',
        'class_code',
        'start_date',
        'end_date',
        'close_date',
        'is_active',
    ];

    public function tcc(){
        return $this->belongsToMany(Tcc::class);
    }

    public function studentHistories()
    {
        return $this->hasMany(StudentHistory::class);
    }


}
