<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiagnosticoTest extends Model
{
    protected  $table = 'diagnostico_test';
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'diagnostico_test',
        'test_id'
    ];

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

    public function diagnostico(){

        return $this->belongsTo(User::class, 'user_id');
    }
}
