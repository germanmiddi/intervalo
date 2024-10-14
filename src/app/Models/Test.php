<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Test extends Model
{
    protected  $table = 'test';
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'person_id',
        'user_id',
        'fecha',
        'status_id',
        'type_id',
    ];

    // Valor por defecto.
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($test) {
            if (is_null($test->type_id)) {
                $type = TestType::where('description', 'Competencia')->first();
                $test->type_id = $type['id'];
            }
        });
    }

    // Relaciones
    public function person(){

        return $this->belongsTo(Person::class, 'person_id');
    }

    public function user(){

        return $this->belongsTo(User::class, 'user_id');
    }

    public function status()
    {
        return $this->belongsTo(TestStatus::class);
    }

    public function type()
    {
        return $this->belongsTo(TestType::class, 'type_id');
    }

    public function test_detail()
    {
        return $this->hasMany(TestDetail::class);
    }

    public function diagnostico()
    {
        return $this->hasOne(DiagnosticoTest::class);
    }
}
