<?php

namespace App\Http\Controllers\Manager\Competencia;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

use App\Models\Competencia;

class CompetenciaController extends Controller
{
    public function index()
    {

        $result = Competencia::query();
        
        return  Inertia::render('Manager/Competencias/List', 
        [
            'competencias' =>  $result->paginate(999)
                                    ->withQueryString()
                                    ->through(fn ($c) => [
                                        'id'            => $c->id,
                                        'competencia'   => $c->competencia,
                                        'definicion'    => substr($c->definicion,0,50) . '...',
                                        'comportamiento'=> $c->comportamiento,
                                        ])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return  Inertia::render('Manager/Competencias/Create');        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

        Competencia::create($request->all());

        return Redirect::route('competencia.list');
        
    }


}
