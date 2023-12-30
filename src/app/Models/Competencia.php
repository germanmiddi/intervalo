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
        'resume',
        'category_id'
    ];

    use HasFactory;
    use SoftDeletes;

    public function afirmations()
    {
        return $this->belongsToMany(Afirmation::class);
    } 

    public function Capsules()
    {
        return $this->belongsToMany(Capsule::class);
    }
    
    public function category(){

        return $this->belongTo(Category::class);
    }

    public function competencias_relate()
    {
        return $this->hasMany(CompetenciaRelated::class);
    }

    public function companies(){
        return $this->belongsToMany(Companie::class, 'companies_competencias');
    }

    
}
