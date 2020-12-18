<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Actions\Fortify\PasswordValidationRules;

class GestionUsuariosController extends Controller
{
    use PasswordValidationRules;

    public function index(){
        //validar que sea Super_Usuario
        $this->authorize('consultar', User::class);
        return view('/gestionUsuarios/menuUsuarios');
    }

    public function show(){
        //validar que sea Super_Usuario
        $this->authorize('consultar', User::class);
        $usuarios = User::paginate();
        return view('/gestionUsuarios/usuarios/consulta',compact('usuarios'));
    }

    public function alta(){
        //validar que sea Super_Usuario
        $this->authorize('alta', User::class);
        return view('/gestionUsuarios/usuarios/alta');
    }

    public function store(Request $request){
        //validar que sea Super_Usuario
        $this->authorize('alta', User::class);
        $usuario = new User();
    
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:30', 'unique:users'],
            'password' => $this->passwordRules(),
        ])->validate();

        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request['password']);
        $usuario->Legajo = $request->legajo;
        //$usuario->Activo = 1;

        //Se guardan los datos en la BD
        $usuario->save();

        //Regresa a la vista anterior
        return redirect()->route('usuario.consulta');
    }

    /*
    Descripción: Eliminación lógica. El método recibe como argumento un objeto usuario que se desea eliminar,
    actualiza el valor del atributo activo seteando dicho valor a 0, guarda los cambios en la BD
    y retorna a la vista de consultas.
    Autor: Maximiliano Robledo
    Fecha: 19/11/2020
    Version: 1.0
    Argumento $usuario
    */
    public function destroy(User $usuario){
        //validar que sea Super_Usuario
        $this->authorize('baja', User::class);
        $usuario->Activo = 0;
        $usuario->save();
        return redirect()->route('usuario.consulta')->with('eliminar','ok');
        //return $usuario;
        //$usuario->delete();
    }

}
