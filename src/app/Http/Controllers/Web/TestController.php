<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\Test;
use App\Models\TestDetail;
use App\Models\TestStatus;
use App\Models\CompetenciaRelated;


use Carbon\Carbon;


class TestController extends Controller
{
    public function store(Request $request)
    {   
        try {
            $controllerPerson = New PersonController();
            if(Person::where('email',$request->form_person['email'])->exists()){
                $data_person = $controllerPerson->update($request->form_person);
            }else{
                $data_person = $controllerPerson->store($request->form_person);
            }

            if($data_person['code'] == 200){
                $test = Test::create([
                    'person_id' => $data_person['data']['id'],
                    'fecha' => Carbon::now(),
                    'status_id' => TestStatus::select('id')->where('description', 'ABANDONED')->first()->id,
                ]);
                
                foreach ($request->form_competencias as $competencia) {
                    TestDetail::create([
                        'test_id' => $test->id,
                        'competencia_related_id' =>  CompetenciaRelated::select('id')->where('competencia_id', $competencia)->where('relate_id', $competencia)->first()->id,
                        'score' => 0,
                    ]);
                }

                $controllerAfirmation = New AfirmationController();

                $afirmations = $controllerAfirmation->get_afirmations($request->form_competencias);

                return response()->json(['message'=>'Se registrado correctamente', 'data' => $afirmations, 'person' => $data_person, 'test' => $test],200);
            }
        } catch (\Throwable $th) {
            dd($th);
            return response()->json(['message'=>'Se ha producido un error'],500);
        }
    }
}
