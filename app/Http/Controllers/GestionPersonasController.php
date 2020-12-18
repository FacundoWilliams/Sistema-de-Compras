<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use Illuminate\Support\Facades\DB;


class GestionPersonasController extends Controller
{

    public function menu(){
        //validar que sea Super_Usuario
        $this->authorize('consultar', Persona::class);
        
        $personas = Persona::all()
        ->where('Activo',1);
        return view('gestionUsuarios/personas/menu')
        ->with('personas',$personas);  
    }

    //Almacena los datos del formulario
    public function store( Request $request){ 
        //validar que sea Super_Usuario
        $this->authorize('alta', Persona::class);

        $persona = new Persona();
        $persona->Legajo =$request->legajo;
        $persona->Nombre =$request->nombre;
        $persona->Apellido =$request->apellido;
        $persona->DNI =$request->dni;
        $persona->Cuil =$request->cuil;
        $persona->telefono =$request->telefono;
        $persona->mail =$request->mail;
        $persona->direccion =$request->dir;
      
        //Se guardan los datos en la BD si el legajo de la persona no existe
        $existe =  Persona::find($request->legajo);
        if($existe == NULL){
            try{
                $persona->save();
                //Regresa a la vista de consultas
                return redirect()->route('personas.menu')->with('success','Persona registrado exitosamente');
            }catch(\Exception $e){
                return redirect()->route('personas.menu')->with('error','Error al intentar registrar persona. Datos inválidos ' +$e);            
            }
        }
        return redirect()->route('personas.menu')->with('error','El legajo de la persona ya existe.');            
    }
     
    /**
     * Función pública que recibe los datos editados para una persona y actualiza la información
     * en la BD.
     */
    public function editar(Request $request){
        //validar que sea Super_Usuario
        $this->authorize('modificar', Persona::class);
        //return $request;
        $persona = Persona::find($request->legajo);
        $persona->Legajo =$request->legajo;
        $persona->Nombre =$request->nombre;
        $persona->Apellido =$request->apellido;
        $persona->DNI =$request->dni;
        $persona->Cuil =$request->cuil;
        $persona->telefono =$request->telefono;
        $persona->mail =$request->mail;
        $persona->direccion =$request->dir;
        //Se guardan los datos en la BD
        $persona->update();
        //Regresa a la vista de consultas
        return redirect()->route('personas.menu');
    }

    public function eliminar(Request $request){
        $this->authorize('eliminar', Persona::class);
        DB::table('personas')
        ->where('personas.legajo',$request->legajo)       
        ->update(['Activo'=> 0]);   
        return redirect()->route('personas.menu')->with('success','Persona eliminada exitosamente');
    }
    
}
