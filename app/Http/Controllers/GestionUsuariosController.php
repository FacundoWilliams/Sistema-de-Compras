<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Actions\Fortify\PasswordValidationRules;
use App\Models\Rol;
use App\Models\Usuario_Rol;
use Illuminate\Support\Facades\DB;


class GestionUsuariosController extends Controller
{
    use PasswordValidationRules;

    public function menu(){
        //validar que sea Super_Usuario
        $this->authorize('consultar', User::class);
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
        $this->authorize('modificar', User::class);
        //return $request;
        $usuario = User::find($request->name);
        DB::table('users')
        ->where('users.name',$request->name)       
        ->update(['email'=> $request->email, 'password'=> $request->password]);  
        //Regresa a la vista de consultas
        return redirect()->route('usuario.menu')->with('success','Usuario actualizado exitosamente'); ;
    }

    public function verAsignarRol($usuarioid){
        //validar que sea Super_Usuario
        $this->authorize('alta', Usuario_Rol::class);
        
        $all_roles=Rol::all();
        
        $roles_previos=DB::table('usuarios_roles')
        ->join('users','users.id','=','usuarios_roles.UsuarioID')
        ->where('usuarios_roles.UsuarioID',$usuarioid)->get();

        //Recorro todos los roles y solo guardo los que el usuario no tenga para ser asignados en la vista
        $rol=array();
        $i=0;
        foreach($all_roles as $a){
        $j=0;
        $b=true;
        while($b and ($j<count($roles_previos))){
          if($a->RolID== $roles_previos[$j]->RolID){
            $b=false;
          }
          $j++;
        }
        if($b){
          $rol[$i]=$a;
          $i++;
        }
      }
      return view('/gestionUsuarios/usuarios/asignarRoles')
        ->with('roles' ,$rol)
        ->with('usuarioid' ,$usuarioid);
    }
    public function asignarRoles(Request $request,$usuarioid){
         //validar que sea Super_Usuario
         $this->authorize('alta', Usuario_Rol::class);
        //creamos los vinculos entre usuario y rol
        foreach($request->roles as $r){
            $usu_r=new Usuario_Rol();
            $usu_r->RolID=$r;
            $usu_r->UsuarioID=$usuarioid;
            $usu_r->FechaHoraRegistro=date("Y-n-j");
            $usu_r->save();
        }
        return redirect()->route('usuario.menu');

    }
    public function desasignarRoles(Request $request,$usuarioid){
         //validar que sea Super_Usuario
         $this->authorize('baja', Usuario_Rol::class);
         foreach($request->roles as $r){
            DB::table('usuarios_roles')
            ->where('usuarios_roles.UsuarioID',$usuarioid)
            ->where('usuarios_roles.RolID',$r)->delete();
        }
        return redirect()->route('usuario.menu');

    }
    
    
    public function verDesasignarRol($usuarioid){
        $this->authorize('baja', Usuario_Rol::class);
        $rol=DB::table('usuarios_roles')
        ->join('users','users.id','=','usuarios_roles.UsuarioID')
        ->where('usuarios_roles.UsuarioID',$usuarioid)->get();
        return view('/gestionUsuarios/usuarios/desasignarRoles')
        ->with('roles' ,$rol)
        ->with('usuarioid' ,$usuarioid);
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
