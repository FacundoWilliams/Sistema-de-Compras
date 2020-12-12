<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use Faker\Provider\ar_JO\Person;

class GestionPersonasController extends Controller
{

    public function menu(){
        $personas = Persona::all();
        return view('gestionUsuarios/personas/menu')
        ->with('personas',$personas);  
    }

    public function registro(){
        return view('/gestionUsuarios/personas/registroPersona');
    }

    //Almacena los datos del formulario
    public function store( Request $request){      
       $persona = new Persona();
       $persona->Legajo =$request->legajo;
       $persona->Nombre =$request->nombre;
       $persona->Apellido =$request->apellido;
       $persona->DNI =$request->dni;
       $persona->Cuil =$request->cuil;
       $persona->telefono =$request->telefono;
       $persona->mail =$request->mail;
       $persona->direccion =$request->dir;
       //Se guardan los datos en la BD
       $persona->save();
    }

    //mostrar los datos de la tabla Personas
    public function show(){
        //si usamos ::all me da todos los registros de la tabla, ::paginate para que te devuelva todos pero paginados
        $personas = Persona::paginate();
        return view('/gestionaUsuarios/personas/consultarpersona',compact('personas'));
    }


    /**
     * Función pública que recibe los datos editados para una persona y actualiza la información
     * en la BD.
     */
    public function editar(Request $request){
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
    
}
