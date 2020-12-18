<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Actions\Fortify\PasswordValidationRules;
use Illuminate\Support\Facades\DB;


class GestionUsuariosController extends Controller
{
    use PasswordValidationRules;

    public function menu(){
        //validar que sea Super_Usuario
        $this->authorize('consultar', Sector::class);
        $usuarios = User::all()
        ->where('Activo',1);
        return view('gestionUsuarios/usuarios/menu')
        ->with('usuarios',$usuarios);
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

        //Se guardan los datos en la BD
        $usuario->save();

        //Regresa a la vista anterior
        return redirect()->route('usuario.menu')->with('success','Usuario creado exitosamente');
    }

    public function eliminar(Request $request){
        //validar que sea Super_Usuario
        $this->authorize('baja', User::class);
        DB::table('users')
        ->where('users.id',$request->id)       
        ->update(['Activo'=> 0]);   
        return redirect()->route('usuario.menu')->with('success','Usuario eliminado exitosamente'); 
    }

    public function alta(){
        //validar que sea Super_Usuario
        $this->authorize('alta', User::class);
        return view('/gestionUsuarios/usuarios/alta');
    }

    public function editar(Request $request){
        //return $request;
        $usuario = User::find($request->name);
        DB::table('users')
        ->where('users.name',$request->name)       
        ->update(['email'=> $request->email, 'password'=> $request->password]);  
        //Regresa a la vista de consultas
        return redirect()->route('usuario.menu')->with('success','Usuario actualizado exitosamente'); ;
    }


    //Los metodos siguientes no son necesarios. 
    /*public function index(){
        //validar que sea Super_Usuario
        $this->authorize('consultar', User::class);
        return view('/gestionUsuarios/menuUsuarios');
    }*/

    /*public function show(){
        //validar que sea Super_Usuario
        $this->authorize('consultar', User::class);
        $usuarios = User::paginate();
        return view('/gestionUsuarios/usuarios/consulta',compact('usuarios'));
    }*/

    
}
