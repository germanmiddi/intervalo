<?php

namespace App\Http\Controllers\Manager\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;

use App\Models\Test;
use App\Models\TestDetail;
use App\Models\Competencia;

use App\Exports\TestsExport;
use Maatwebsite\Excel\Facades\Excel;

class TestController extends Controller
{
    public function index()
    {
        return  Inertia::render('Manager/Test/List', 
        [
            'competencias' =>  Competencia::all()
        ]);
    }

    public function list(){

        $length = request('length');
        $result = TestDetail::query();

        $sort_by = request('sort_by') ?? 'p.name';
        $sort_order = request('sort_order') ?? 'DESC';

        $result->join('competencias_related as cr', function($join)
                        {
                            $join->on('test_detail.competencia_related_id', '=', 'cr.id');
                            $join->on('cr.competencia_id','=','cr.relate_id');
                        });

        $result->join('test as t', 'test_detail.test_id', '=', 't.id');
        $result->join('test_status as ts', 't.status_id', '=', 'ts.id');
        $result->leftjoin('persons as p', 't.person_id', '=', 'p.id');
        $result->leftjoin('users as u', 't.user_id', '=', 'u.id');
       
        
        if(request('search')){
            $result->where('p.name','LIKE', '%' . request('search') . '%' );
            $result->orWhere('p.lastname','LIKE', '%' . request('search') . '%' );
            $result->orWhere('ts.description','LIKE', '%' . request('search') . '%' );
            $result->orWhere('u.name','LIKE', '%' . request('search') . '%' );
        }

        if(request('competencia')){
            $result->where('cr.competencia_id',request('competencia'));
        }

        return $result->orderBy($sort_by, $sort_order)
                        ->paginate($length)
                        ->withQueryString()
                        ->through(fn ($t) => [
                                'person'          => $t->test->person ?? '',
                                'user'            => $t->test->user ?? '',
                                'competencia'     => $t->competencia_related->competencia->competencia,
                                'fecha'           => Carbon::parse($t->test->fecha)->format("d-m-Y"),
                                'status'          => $t->test->status->description,
                                'score'           => $t->score 
                        ]);

        
        /* $result = Test::query();
        
        if(request('search')){
            $result->where('id','LIKE', '%' . request('search') . '%' );
        }

        return $result->paginate($length)
                        ->withQueryString()
                        ->through(fn ($t) => [
                                'person'          => $t->person,
                                'competencia'     => $t->competencia_related_id,
                                'fecha'           => Carbon::parse($t->fecha)->format("d-m-Y"),
                                'status'          => $t->status->description,
                                'score'           => $t->status_id
                        ]); */


    }

    public function download_excel(){
        return Excel::download(new TestsExport, 'Resumen Test.xlsx');
    }
}
