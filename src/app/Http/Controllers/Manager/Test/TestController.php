<?php

namespace App\Http\Controllers\Manager\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;

use App\Models\Test;
use App\Models\TestDetail;

class TestController extends Controller
{
    public function index()
    {
        return  Inertia::render('Manager/Test/List');
    }

    public function list(){

        $length = request('length');
        $result = TestDetail::query();
        
        if(request('search')){
            $result->where('id','LIKE', '%' . request('search') . '%' );
        }

        return $result->paginate($length)
                        ->withQueryString()
                        ->through(fn ($t) => [
                                'person'          => $t->test->person,
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
}
