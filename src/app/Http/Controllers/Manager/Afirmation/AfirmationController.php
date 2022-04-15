<?php

namespace App\Http\Controllers\Manager\Afirmation;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

use App\Models\Afirmation;
use App\Models\Competencia;

class AfirmationController extends Controller
{
    public function index()
    {
        $result = Afirmation::query();
        
        return  Inertia::render('Manager/Afirmations/List', 
        [
            'afirmaciones' =>  $result->paginate(999)
                                    ->withQueryString()
                                    ->through(fn ($a) => [
                                        'id'     => $a->id,
                                        'text'   => $a->text
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
        
        $competencia = Competencia::all()->toArray();
        
        $comp_list = array_map(function ($c){
                        return 
                        [
                            'value'=> $c['id'],
                            'label' => $c['competencia']
                        ];
                    }, $competencia);


        return  Inertia::render('Manager/Afirmations/Create',[
            'competencias' => $comp_list
        ]);        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        // dd($request->input());
        Afirmation::create($request->all())->competencias()->attach($request->input("tags"));

        return Redirect::route('afirmation.list');
        
    }

}
