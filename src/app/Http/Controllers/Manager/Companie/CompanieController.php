<?php

namespace App\Http\Controllers\Manager\Companie;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Companie;
use App\Models\Competencia;
use App\Models\Diagnostico;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Support\Str;
use Inertia\Inertia;

class CompanieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  Inertia::render('Manager/Companie/List', [
            'toast' => FacadesSession::get('toast')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  Inertia::render(
            'Manager/Companie/Create',
            [
                "competencias"  => Competencia::all()
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $companie = Companie::create([
                'description' => $request->description,
                'address' => $request->address ?? null,
                'contact_name' => $request->contact_name ?? null,
                'contact_email' => $request->contact_email ?? null,
                'contact_phone' => $request->contact_phone ?? null,
            ]);

            foreach ($request->competencias_select as $c) {
                $companie->competencias()->attach($c['id']);
            }
            return Redirect::route('companie')->with('toast', ['message' => 'Empresa creada con éxito', 'status' => 200]);
        } catch (\Throwable $th) {
            return Redirect::route('companie')->with('toast', ['message' => 'Se ha producido un error al momento de crear la Empresa', 'status' => 203]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $companie = Companie::where('id', $id)->first();

        return Inertia::render('Manager/Companie/Edit', [
            'competencias'  => Competencia::all(),
            'companie'      => $companie,
            'competencias_asociadas' => $companie->competencias,
            'categorias' => Category::with('competencias')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            Companie::where('id', $request->id)->update([
                'description' => $request->description,
                'address' => $request->address ?? null,
                'contact_name' => $request->contact_name ?? null,
                'contact_email' => $request->contact_email ?? null,
                'contact_phone' => $request->contact_phone ?? null,
            ]);

            $companie = Companie::find($request->id);
            $competenciasParaSync = [];
            foreach ($request->competencias_select as $c) {
                $competenciasParaSync[] = $c['id']; //$companie->competencias()->attach($c['id']);
            }

            $companie->competencias()->sync($competenciasParaSync);
            return Redirect::route('companie')->with('toast', ['message' => 'Empresa actualizada con éxito', 'status' => 200]);
        } catch (\Throwable $th) {
            return Redirect::route('companie')->with('toast', ['message' => 'Se ha producido un error al momento de actualizar la Empresa', 'status' => 203]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $companie = Companie::where('id', $id)->first();
            $companie->active = $companie->active == 1 ? 0 : 1;
            $companie->save();
            return response()->json(['message' => 'Se actualizado correctamente la Empresa.'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Se ha producido un error al momento de actualizar la Empresa'], 500);
        }
    }

    public function list()
    {
        $length = request('length');

        $result = Companie::query();

        if (request('description')) {
            $description = request('description');
            $result->where('description', 'LIKE', '%' . $description . '%');
        }

        if (request('contact')) {
            $contact = request('contact');
            $result->Where('contact_name', 'LIKE', '%' . $contact . '%')
                ->orWhere('contact_email', 'LIKE', '%' . $contact . '%')
                ->orWhere('contact_phone', 'LIKE', '%' . $contact . '%');
        }


        return  $result->orderBy("created_at", 'DESC')
            ->paginate($length)
            ->withQueryString()
            ->through(fn($c)   => [
                'id'            => $c->id,
                'description'   => $c->description,
                'address'       => STR::limit($c->address, 50, '...'),
                'contact_name'  => $c->contact_name,
                'contact_email' => $c->contact_email,
                'contact_phone' => $c->contact_phone,
                'active'        => $c->active,
                'competencias'  => $c->competencias,
                'diagnosticos'  => $c->diagnosticos,
            ]);
    }

    public function listUserByCompanie($id)
    {
        $length = request('length');

        $result = User::query();

        $result->whereIn('id', function ($sub) use ($id) {
            $sub->selectRaw('users.id')
                ->from('users')
                ->join('companies_users', 'users.id', '=', 'companies_users.user_id')
                ->where('companies_users.companie_id', $id);
        });

        return  $result->orderBy("created_at", 'DESC')
            ->paginate($length)
            ->withQueryString()
            ->through(fn($c) => [
                'id'    => $c->id,
                'name'  => $c->name,
                'email' => $c->email,
                'rol'   => $c->roles[0]->name
            ]);
    }


    /* MY COMPANIE*/

    public function myCompanie()
    {
        $companie = Companie::where('id', Auth::user()->companies[0]->id)->first();

        return  Inertia::render('Manager/Companie/MyCompanie/Index', [
            'toast' => FacadesSession::get('toast'),
            'companie' => $companie,
            'competencias_asociadas' => $companie->competencias
        ]);
    }

    // Manejo de Diagnosticos
    public function CompanyDiagnosticosById($id)
    {
        $length = request('length') ?? 5;

        $result = Diagnostico::query();

        $result->where('company_id', $id);

        return  $result->with('status')
            ->orderBy("created_at", 'DESC')
            ->paginate($length)
            ->withQueryString();
    }
}
