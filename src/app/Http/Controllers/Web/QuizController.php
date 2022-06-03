<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;

use App\Models\Afirmation;
use App\Models\Competencia;

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
        
        
        $input = $request->request;
        
        $competencias = $this->group_by("id_competencia", $input);
        $comp_rel = [];

        foreach($competencias as $key => $respuestas){
            $cant = count($respuestas);
            $sum = 0;
        
            foreach($respuestas as $r){
                $sum += $r['value'];
                
                // Si el valor es menor a 50, busco las Compt relacionadas a la afirmacion.
                // En caso que la Competencia a evaluar, de mas de 50 %, se recomiendan las capsulas de las compe relacionadas
                if($r['value'] < 50 ){ 
                    $id = $r['id'];

                    $competencias = Competencia::select('id')
                                                ->wherehas('afirmations', function($query) use ($id){
                                                                            $query = $query->where('afirmation_id', $id);
                                                                        })
                                                ->where('id', '!=',$key) //Levanto solo las competencias distintas a la q estoy sumando
                                                // ->with('capsules')
                                                ->get()->toArray();
                    
                    $comp_rel = array_merge($comp_rel, $competencias);
                }

            }

            $promedio = $sum / $cant;
           

            $capsules = array(); //"";
            $list = [];

            // foreach($comp_rel as $m){
            //     $list[] = $m['id']; 
            // }
            // dd(count($comp_rel));
            $compe = Competencia::select('id', 'competencia')->where('id',$key)->with('capsules')->first();

            if($promedio < 50){
                $capsules = $compe->capsules;

            }elseif( count($comp_rel) > 0){
                
                $compe_aux = Competencia::select('id', 'competencia')->whereIn('id',$comp_rel)->with('capsules')->get()->toArray();
                // $capsules = Arr::get($compe_aux,'capsules');
                $caps = array_map( function($e){return $e['capsules'];}, $compe_aux);
                
                // $capsules = new Array();
                foreach($caps as $c){  $capsules += $c; }
                
            }
            
            $resultado[] = [ 'competencia' => $compe->competencia, 
                             'promedio' => round($promedio/5) * 5 ,
                             'capsules' => $capsules,
                             'comp_rel' => $comp_rel ];

        }
        

        // $sum = array_sum(array_map(fn ($item) => $item['qty'], $respuestas));
        return response()->json($resultado, 200);
        
        // return  Inertia::render('Web/Result');

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