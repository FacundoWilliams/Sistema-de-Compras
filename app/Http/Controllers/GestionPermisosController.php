<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permiso;

class GestionPermisosController extends Controller
{
    public function registro(){
        return view('/gestionUsuarios/permisos/registroPermiso');
    }

    public function store(Request $request){
       $permiso = new Permiso();
       $permiso->PermisoID =$request->permisoID;
       $permiso->descripcion=$request->descripcion;
       $permiso->PathAuth=$request->permiso;
       //Se guardan los datos en la BD
       $permiso->save();

    }
}
