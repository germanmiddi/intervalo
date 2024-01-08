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
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function store(Request $request)
    {   

        try {
            DB::beginTransaction();
            $controllerPerson = New PersonController();
            if(Person::where('email',$request->email)->exists()){
                $data_person = $controllerPerson->update($request);
            }else{
                $data_person = $controllerPerson->store($request);
            }

            if($data_person['code'] == 200){
                $test = Test::create([
                    'person_id' => $data_person['data']['id'],
                    'fecha' => Carbon::now(),
                    'status_id' => TestStatus::select('id')->where('description', 'ABANDONED')->first()->id,
                ]);
                
                $form_competencias = explode(',', $request->input('form_competencias'));

                foreach ($form_competencias as $competencia) {
                    $id_competencia_related = CompetenciaRelated::select('id')
                                                                ->where('competencia_id', $competencia)
                                                                ->where('relate_id', $competencia)
                                                                ->first();
                                                                
                    if ($id_competencia_related) {
                        $id = $id_competencia_related->id;
                    
                        TestDetail::create([
                            'test_id' => $test->id,
                            'competencia_related_id' =>  $id,
                            'score' => 0,
                        ]);
                    }
                }

                $controllerAfirmation = New AfirmationController();

                $afirmations = $controllerAfirmation->get_afirmations($form_competencias);
                DB::commit();
                return response()->json(['message'=>'Se registrado correctamente', 
                                         'data'   => $afirmations, 
                                         'person' => $data_person, 
                                         'test'   => $test], 200);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            return response()->json(['message'=>'Se ha producido un error'],500);
        }
    }

    public function storeUser(Request $request)
    {   
        try {
            DB::beginTransaction();
                $test = Test::create([
                    'user_id' => $request->id,
                    'fecha' => Carbon::now(),
                    'status_id' => TestStatus::select('id')->where('description', 'ABANDONED')->first()->id,
                ]);
                
                $form_competencias = explode(',', $request->form_competencias);

                foreach ($form_competencias as $competencia) {
                    $id_competencia_related = CompetenciaRelated::select('id')
                                                                ->where('competencia_id', $competencia)
                                                                ->where('relate_id', $competencia)
                                                                ->first();
                                                                
                    if ($id_competencia_related) {
                        $id = $id_competencia_related->id;
                    
                        TestDetail::create([
                            'test_id' => $test->id,
                            'competencia_related_id' =>  $id,
                            'score' => 0,
                        ]);
                    }
                }

                $controllerAfirmation = New AfirmationController();

                $afirmations = $controllerAfirmation->get_afirmations($form_competencias);
                DB::commit();
                return response()->json(['message'=>'Se registrado correctamente', 
                                         'data'   => $afirmations, 
                                         'person' => $request->id, 
                                         'test'   => $test], 200);
            
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            return response()->json(['message'=>'Se ha producido un error'],500);
        }
    }
}
