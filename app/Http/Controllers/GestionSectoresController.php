<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sector;
use Illuminate\Support\Facades\DB;


class GestionSectoresController extends Controller
{

    public function menu(){
        //validar que sea Super_Usuario
        $this->authorize('consultar', Sector::class);
        $sectores = Sector::all()
        ->where('Activo',1);
        return view('gestionUsuarios/sectores/menu')
        ->with('sectores',$sectores);
    }

    //Almacena los datos del formulario
    public function store(Request $request){
        //validar que sea Super_Usuario
        $this->authorize('alta', Sector::class);
        $sector = new Sector();
        $sector->descripcion=$request->sector;
        $sector->persona_a_cargo=$request->persona;
       
        //Se guardan los datos en la BD si el legajo de la persona no existe
        $existe =  Sector::find($request->id);
        if($existe == NULL){
            try{
                $sector->save();
                //Regresa a la vista de consultas
                return redirect()->route('sector.menu')->with('success','Sector registrado exitosamente');
            }catch(\Exception $e){
                return redirect()->route('sector.menu')->with('error','Error al intentar registrar sector. Datos inválidos ' +$e);            
            }
        }
        return redirect()->route('sector.menu')->with('error','El identificador del sector ya existe.');   
        
        //Se guardan los datos en la BD
        $sector->save();
    }

    public function editar(Request $request){
        $this->authorize('modificar', Sector::class);    
        $sector = Sector::find($request->id);
        $sector->descripcion=$request->sector;
        $sector->persona_a_cargo=$request->persona;
        //Se guardan los datos en la BD
        $sector->update();
        //Regresa a la vista de consultas
        return redirect()->route('sector.menu');
    }

    public function eliminar(Request $request){
        $this->authorize('baja', Sector::class);
        DB::table('sectores')
        ->where('sectores.SectorID',$request->id)       
        ->update(['Activo'=> 0]);   
        return redirect()->route('sector.menu')->with('success','Sector eliminado exitosamente');
    }

}
