<?php

namespace App\Http\Controllers\Manager\Competencia;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\Competencia;
use App\Models\Category;
use App\Models\Capsule;
use App\Imports\CompetenciaImport;
use Illuminate\Support\Facades\Session;

class CompetenciaController extends Controller
{
    public function index()
    {
        return  Inertia::render('Manager/Competencias/List');

    }

    public function list()
    {
        $length = request('length');
        $result = Competencia::query();
        
        if(request('search')){
            $result->where('competencia','LIKE', '%' . request('search') . '%' );
        }

        return $result->paginate($length)
                        ->withQueryString()
                        ->through(fn ($c) => [
                            'id'            => $c->id,
                            'competencia'   => $c->competencia,
                            'definicion'    => substr($c->definicion,0,50) . '...',
                            'comportamiento'=> $c->comportamiento,
                        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $capsulas = Capsule::all()->toArray();
        
        $capsulas_list = array_map(function ($c){
                        return 
                        [
                            'value'=> $c['id'],
                            'label' => $c['title']
                        ];
                    }, $capsulas);
        
        return  Inertia::render('Manager/Competencias/Create',
                                    [ "categories"  => Category::all(),
                                      "capsules"    => $capsulas_list]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

        Competencia::create($request->all())->capsules()->attach($request->input("tags"));

        return Redirect::route('competencia');
        
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Competencia $competencia)
    {

        $capsulas = Capsule::all()->toArray();
        
        $capsulas_list = array_map(function ($c){
                        return 
                        [
                            'value'=> $c['id'],
                            'label' => $c['title']
                        ];
                    }, $capsulas);

        $capsulas_asignadas = $competencia->Capsules;
        $afirmations_asignadas = $competencia->Afirmations;

        return Inertia::render('Manager/Competencias/Edit', [
                            'competencia' => $competencia,
                            "categories"  => Category::all(),
                            "capsules"    => $capsulas_list
                        ]);

    }    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Competencia $competencia)
    {
        $competencia->update($request->all());
        $competencia->Capsules()->sync($request->input('tags'));

        return Redirect::route('competencia');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Competencia $competencia)
    {
        $competencia->delete();

        return Redirect::back()->with('success', 'Competencia Eliminado');
    }


    /*** IMPORT ***/
    public function import()
    {
        return  Inertia::render('Manager/Competencias/Import',[
            'toast' => Session::get('toast')
        ]);
        
    }    
    
    public function importfile(Request $request )
    {
        $path = $request->file('import_file');
        $import = new CompetenciaImport();
        $data = Excel::import($import, $path);
        $status = $import->getStatus();
        return Redirect::back()->with(['toast' => ['message' => $status, 'status' => '200']]);
    } 

}
