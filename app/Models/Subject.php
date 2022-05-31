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
        'is_active',
        'class',
        'class_code',
        'start_date',
        'end_date',
        'close_date',
    ];

    public function tcc(){
        return $this->belongsToMany(Tcc::class);
    }

    public function manager(){
        return $this->hasOne(Manager::class);
    }
    // public function course(){
    //     return $this->hasOne(Course::class);
    // }

}
