<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;
use App\Models\Permiso;
use App\Models\Rol_Permiso;
use App\Models\Usuario_Rol;

class GestionRolesController extends Controller
{
    
    public function index(){
        //validar que sea Super_Usuario
        $this->authorize('consultar', Rol::class);

        //$roles=new Rol();
        $roles=Rol::all();
       return view('/gestionUsuarios/roles/menu')
        ->with('roles' ,$roles); 
    }
    
    public function registro(){
        //validar que sea Super_Usuario
        $this->authorize('alta', Rol::class);
        return view('/gestionUsuarios/roles/registroRoles');   
    }

    public function store(Request $request){
        //validar que sea Super_Usuario
        $this->authorize('alta', Rol::class);
        $rol = new Rol();
        $rol->RolID =$request->rolID;
        //Se guardan los datos en la BD
        $rol->save();
     }
     public function verAsignacionPermisos($rolid){
        //validar que sea Super_Usuario
        $this->authorize('alta', Usuario_Rol::class);
        
        $permisos=Permiso::all();
        return view('/gestionUsuarios/roles/asignarPermisos')
        ->with('permisos' ,$permisos)
        ->with('rolid' ,$rolid);
    }

    public function asignarPermisos(Request $request, $rolid){
        //validar que sea Super_Usuario
        $this->authorize('alta', Usuario_Rol::class);
        //creamos los vinculos entre usuario y rol
        foreach($request->permisos as $p){
            $rol_p=new Rol_Permiso();
            $rol_p->RolID=$rolid;
            $rol_p->PermisoID=$p;
            $rol_p->FechaHoraRegistro=date("Y-n-j");
            $rol_p->save();
        }
        return redirect()->route('rol.menu');
    }
}
