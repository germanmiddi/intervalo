<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Models\Companie;
use App\Models\Competencia;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()){
            $companie = Companie::where('id', Auth::user()->companies[0]->id)->first();
            $competencias = Competencia::whereIn('id', $companie->competencias->pluck('id')->toArray())->get();
            return  Inertia::render('Web/Home',['competencias' => $competencias ]);
        }else{
            return  Inertia::render('Web/Home',['competencias' => Competencia::all() ]);
        }
    }

}