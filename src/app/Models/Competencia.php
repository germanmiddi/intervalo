<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Competencia extends Model
{
    protected $fillable = [
        'competencia',
        'definicion',
        'comportamiento',
    ];

    use HasFactory;
    use SoftDeletes;

    public function afirmations()
    {
        return $this->belongsToMany(Afirmation::class);
    } 
}
