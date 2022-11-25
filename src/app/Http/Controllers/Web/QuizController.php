<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;

use App\Models\Afirmation;
use App\Models\Competencia;
use App\Models\CompetenciaRelated;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($competencias)
    {
        
        $competencias =  explode(",", $competencias);
        $ids    = [];
        $result = [];
        $output = [];

        foreach($competencias as $c){
            $result = Afirmation::wherehas('competencias',function($query) use ($c){
                                                            $query = $query->where('competencia_id', $c);
                                                        })
                                ->whereNotIn('id',$ids)
                                ->limit(15)
                                ->get()->toArray();
            
            $result_final = array_map(function($r) use ($c) {
                                        $r['id_competencia'] = $c;
                                        return $r;
                                        
                                    },$result);

            $output = array_merge($output, $result_final);
            
            $ids = $ids + array_map(function($r){ return ['id' => $r['id']]; }, $result_final);
           
        }
        return  Inertia::render('Web/Quiz',['afirmations' => $output ]);
    }
    
    public function calculate(Request $request){
        
        //Recupero respuestas.
        $input = $request->request;
        //Agrupo las respuestas segun las competencias.
        $competencias = $this->group_by("id_competencia", $input);
        $comp_rel = [];
        $data = array();
        foreach($competencias as $key => $respuestas){
            $result = array();
            $details_competencia = Competencia::where('id',$key)->first();
            // Comienza la carga del array
            $result[$details_competencia->competencia]['competencia'] = $details_competencia->competencia;
            $result[$details_competencia->competencia]['competencia_id'] = $details_competencia->id;
            $result[$details_competencia->competencia]['suma'] = 0;
            $result[$details_competencia->competencia]['cantidad'] = count($respuestas);
            $result[$details_competencia->competencia]['tipo'] = 'main';

            foreach($respuestas as $r){
                $result[$details_competencia->competencia]['suma'] += $r['value'];
                // Busqueda de las competencias relacionadas a la afirmacion.
                $id = $r['id'];
                $competencias = Competencia::select('id')
                                    ->wherehas('afirmations', function($query) use ($id){
                                                                $query = $query->where('afirmation_id', $id);
                                                            })
                                    ->where('id', '!=', $key) //Levanto solo las competencias distintas a la q estoy sumando
                                    ->get()->toArray();

                // Se Analisis las competencias relacionadas. 
                foreach ($competencias as $c) {
                    $competencia_relate = Competencia::where('id',$c['id'])->first();
                    $exist = false;
                    foreach ($details_competencia->competencias_relate as $cr) {
                        if($c['id'] === $cr->relate_id){
                            $exist = true;
                        }
                    }
                    // Se verifica si existe la relacion de la competencia con sus competencias relacionadas. 
                    if($exist){
                        $result[$competencia_relate->competencia]['competencia'] = $competencia_relate->competencia;
                        $result[$competencia_relate->competencia]['competencia_id'] = $c['id'];
                        //Verifica si es la primera ves que se carga las suma y cantidad
                        if(!isset($result[$competencia_relate->competencia]['suma'])){
                            $result[$competencia_relate->competencia]['suma'] = $r['value'];
                            $result[$competencia_relate->competencia]['cantidad'] = 1;
                        }else{
                            $result[$competencia_relate->competencia]['suma'] += $r['value'];
                            $result[$competencia_relate->competencia]['cantidad'] += 1;
                        }
                        $result[$competencia_relate->competencia]['tipo'] = 'related';
                    }
                }
            }
            // Se cargan los feedback y las capsulas..
            foreach ($result as $r) {
                $result[$r['competencia']]['promedio'] = round(($r['suma']/$r['cantidad'])/5) * 5 .'%';

                $feedback = CompetenciaRelated::where('competencia_id', $details_competencia->id)->where('relate_id', $r['competencia_id'])->first();
                if(($r['suma']/$r['cantidad']) >= 50){
                    $result[$r['competencia']]['texto'] = $feedback->feedback_approve ?? '';
                }else{
                    $result[$r['competencia']]['texto'] = $feedback->feedback_disapprove ?? '';
                }

                $capsulas = Competencia::select()->where('id',$r['competencia_id'])->with('capsules')->get()->toArray();
                foreach ($capsulas[0]['capsules'] as $cap) {
                    $result[$r['competencia']]['capsulas'][$cap['id']] = $cap['title'];
                }
            }
            array_push($data, $result);
        }
        //$resultado[] = ['data' => $data];
        
        return response()->json($data, 200);
        
    }

    function group_by($key, $data) {
        $result = array();
    
        foreach($data as $val) {
            if(array_key_exists($key, $val)){
                $result[$val[$key]][] = $val;
            }else{
                $result[""][] = $val;
            }
        }
    
        return $result;
    }

}