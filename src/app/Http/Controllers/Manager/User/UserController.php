<?php

namespace App\Http\Controllers\Manager\User;

use App\Http\Controllers\Controller;
use App\Models\Companie;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Inertia\Inertia;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  Inertia::render('Manager/User/List',
        [
            'roles' => Rol::all(),
            'empresas' => Companie::active()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        DB::beginTransaction();
        try {
            $randomPassword = Str::random(15); 

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($randomPassword) 
            ]);

            // Asignar Empresa
            $user->companies()->sync($request->idCompanie);

            // Asignar Rol
            $user->roles()->sync($request->idRol);

            //$user->sendEmailVerificationNotification();
            DB::commit();
            return response()->json(['message'=>'Se ha almacenado correctamente el usuario'], 200);    
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message'=>'Se ha producido un error al momento de almacenar el usuario'], 500);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function list(){
        return  User::orderBy("created_at", 'DESC')
                        ->paginate(999)
                        ->withQueryString()
                        ->through(fn ($u) => [
                            'id'        => $u->id,
                            'name'      => $u->name,
                            'email'     => $u->email,
                            'empresa'   => $u->companies->first(),
                            'rol'       => $u->roles->first()    
                        ]);

    } 

    public function sendResetLink(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
            ]);
    
            $status = Password::sendResetLink(
                $request->only('email')
            );

            if($status === 'passwords.sent'){
                return response()->json(['message' => 'Se ha enviado correctamente el email de recupero.'], 200);
            }else{
                return response()->json(['message'=>'Demasiados intentos de restablecimiento de contraseña. Por favor, inténtelo de nuevo más tarde.'], 203);    
            }
        } catch (\Throwable $th) {
            return response()->json(['message'=>'Se ha producido un error al momento de enviar el email'], 500);
        }

    }
}
