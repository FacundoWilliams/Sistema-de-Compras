<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permiso;
use Illuminate\Support\Facades\DB;


class GestionPermisosController extends Controller
{
    public function index(){
        $permiso=Permiso::all();
        return view('/gestionUsuarios/permisos/menu')
        ->with('permisos',$permiso);
    }
    
    public function registro(){
        //validar que sea Super_Usuario
        $this->authorize('alta', Permiso::class);
        return view('/gestionUsuarios/permisos/registroPermiso');
    }

    public function store(Request $request){
       //validar que sea Super_Usuario
       $this->authorize('alta', Persona::class);
       $permiso = new Permiso();
       $permiso->PermisoID =$request->permisoID;
       $permiso->descripcion=$request->descripcion;
       $permiso->PathAuth=$request->opcion;
       //Se guardan los datos en la BD
       $permiso->save();
       return redirect()->route('permiso.menu')->with('success','Permiso registrado exitosamente.');            
    }

    public function eliminar(Request $request){
        //validar que sea Super_Usuario
        $this->authorize('alta', Persona::class);
        DB::table('permisos')
        ->where('PermisoID',$request->id)
        ->delete();
        return redirect()->route('permiso.menu')->with('success','Permiso eliminado exitosamente.');            
    }
}
