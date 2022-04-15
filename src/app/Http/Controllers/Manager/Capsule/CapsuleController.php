<?php

namespace App\Http\Controllers\Manager\Capsule;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

use App\Models\Capsule;

class CapsuleController extends Controller
{
    public function index()
    {

        $result = Capsule::query();
        
        return  Inertia::render('Manager/Capsules/List', 
        [
            'capsules' =>  $result->paginate(999)
                                    ->withQueryString()
                                    ->through(fn ($c) => [
                                        'id'          => $c->id,
                                        'title'       => $c->title,
                                        'description' => substr($c->description,0,50) . '...',
                                        'image'       => $c->image,
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
        return  Inertia::render('Manager/Capsules/Create');        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

        Capsule::create($request->all());

        return Redirect::route('capsule.list');
        
    }



}
