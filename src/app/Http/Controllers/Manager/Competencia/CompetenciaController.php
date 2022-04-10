<?php

namespace App\Http\Controllers\Manager\Competencia;

use Illuminate\Http\Request;
use App\Models\Competencia;



class CompetenciaController extends Controller
{
    public function index()
    {

        $result = Competencia::query();
        
        // if(request('search')){
        //     $result->where('name', 'LIKE', '%'.request('search').'%');
        //     $result->orWhere('lastname', 'LIKE', '%'.request('search').'%');
        //     $result->orWhere('fullname', 'LIKE', '%'.request('search').'%');
        //     $result->orWhere('title', 'LIKE', '%'.request('search').'%');
        // }

        // if(request('length')){
        //     $length = request('length');
        // }else{
        //     $length = 10;
        // }
        
        return  Inertia::render('Manager/Competencias/List', 
        [
            // 'section'   => 'Libros',
            // 'title'     => 'Listado',
            // 'filters'   => request()->all(['search', 'length']),
            'competencias' =>  $result->paginate($length)
                                    ->withQueryString()
                                    ->through(fn ($c) => [
                                        'id'            => $c->id,
                                        'competencia'   => $c->competencia,
                                        'definicion'    => $c->definicion,
                                        'comportamiento'=> $c->comportamiento,
                                        ]);
        ]);
    }
}
