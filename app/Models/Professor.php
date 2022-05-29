<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'titration',
        'organ',
    ];

    public function tcc()
    {
        return $this->belongsToMany(Tcc::class);
    }

    public function manager()
    {
        return $this->belongsTo(Manager::class);
    }
}
