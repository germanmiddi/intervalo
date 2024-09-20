<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Diagnostico extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'diagnosticos';
    protected $fillable = [
        'name',
        'date_start',
        'date_finish',
        'diagnostico_360',
        'status_id',
        'company_id'
    ];

    // Valor por defecto estado al momento de crear un nuevo diagnostico.
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($diagnostico) {
            if (is_null($diagnostico->status_id)) {
                $status = DiagnosticoStatus::where('description', 'Borrador')->first();
                $diagnostico->status_id = $status['id'];
            }
        });
    }

    // FORMAT

    public function setDateStartAttribute($value)
    {
        $this->attributes['date_start'] = \Carbon\Carbon::parse($value);
    }

    public function setDateFinishAttribute($value)
    {
        $this->attributes['date_finish'] = \Carbon\Carbon::parse($value);
    }


    // RELACIONES
    public function status(){
        return $this->belongsTo(DiagnosticoStatus::class);
    }

    public function Company(){
        return $this->belongsTo(Companie::class, 'companies', 'company_id');
    }

}
