<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;
use App\Models\Permiso;
use App\Models\Rol_Permiso;
use App\Models\Usuario_Rol;
use Illuminate\Support\Facades\DB;

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
        
        $all_permisos=Permiso::all();
        
        $permisos_previos=DB::table('roles_permisos')
        ->join('permisos','permisos.PermisoID','=','roles_permisos.PermisoID')
        ->where('roles_permisos.RolID',$rolid)->get();

        //Recorro todos los permisos y solo guardo los que el usuario no tenga para ser asignados en la vista
        $per=array();
        $i=0;
        foreach($all_permisos as $a){
        $j=0;
        $b=true;
        while($b and ($j<count($permisos_previos))){
          if($a->PermisoID== $permisos_previos[$j]->PermisoID){
            $b=false;
          }
          $j++;
        }
        if($b){
          $per[$i]=$a;
          $i++;
        }
      }
      return view('/gestionUsuarios/roles/asignarPermisos')
        ->with('permisos' ,$per)
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

    public function verPermisos($rolid){
        //validar que sea Super_Usuario
        $this->authorize('consultar', Rol::class);
        $permisos=DB::table('roles_permisos')
        ->join('permisos','permisos.PermisoID','=','roles_permisos.PermisoID')
        ->where('roles_permisos.RolID',$rolid)->get();
        return view('/gestionUsuarios/roles/verPermisos')
        ->with('permisos' ,$permisos)
        ->with('rolid' ,$rolid);
    }
    public function verQuitarPermisos($rolid){
        //validar que sea Super_Usuario
        $this->authorize('baja', Rol::class);

        $permisos=DB::table('roles_permisos')
        ->join('permisos','permisos.PermisoID','=','roles_permisos.PermisoID')
        ->where('roles_permisos.RolID',$rolid)->get();

        return view('/gestionUsuarios/roles/QuitarPermisos')
        ->with('permisos' ,$permisos)
        ->with('rolid' ,$rolid);
    }

    public function quitarPermisos(Request $request, $rolid){
        //validar que sea Super_Usuario
        $this->authorize('baja', Usuario_Rol::class);
        //creamos los vinculos entre usuario y rol

        foreach($request->permisos as $p){
            DB::table('roles_permisos')
            ->where('roles_permisos.RolID',$rolid)
            ->where('roles_permisos.PermisoID',$p)->delete();
        }
        return redirect()->route('rol.menu');
    }
}
