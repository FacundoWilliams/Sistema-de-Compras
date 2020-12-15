<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;

class GestionProveedoresController extends Controller
{
    
    public function menu(){
        $proveedores = Proveedor::all();
        return view('gestionProveedores/menu')
        ->with('proveedores',$proveedores);    
     }

    //Almacena los datos del formulario
    public function alta( Request $request){
        $proveedor = new Proveedor();
        $proveedor->Nombre = $request->nombre;
        $proveedor->Razon_social = $request->razon_social;
        $proveedor->Cuit = $request->cuit;
        $proveedor->Condicion_Iva = $request->iva;
        $proveedor->Direccion = $request->direccion;
        $proveedor->Telefono = $request->telefono;
        $proveedor->mail = $request->mail;
        $proveedor->Localidad = $request->localidad;
        $proveedor->Provincia = $request->provincia;
        $proveedor->Activo=1;
        //Se guardan los datos en la BD
        $proveedor->save();
        //Regresa a la vista de consultas
        return redirect()->route('gestionProveedores.menu')->with('success','Proveedor registrado exitosamente');
    }
    
    /**
    * Función que elimina de manera lógica un proveedor.
    */
    public function eliminar(Request $request){            
        //return $request;
        $proveedor = Proveedor::find($request->id);
        $proveedor->Activo=0;
        //Se guardan los datos en la BD
        $proveedor->update();
        //Regresa a la vista de consultas
        return redirect()->route('gestionProveedores.menu')->with('success','Proveedor eliminado exitosamente');
    }

     /**
    * Función que edita un proveedor existente, actualiza la base de datos y retorna la vista al menu principal. 
    */
    public function editar(Request $request){       
        $proveedor = Proveedor::find($request->id);
        $proveedor->Nombre = $request->nombre;
        $proveedor->Razon_social = $request->razon_social;       
        $proveedor->Cuit = $request->cuit;
        $proveedor->Condicion_Iva = $request->iva;
        $proveedor->Direccion = $request->direccion;
        $proveedor->Telefono = $request->telefono;
        $proveedor->mail = $request->mail;
        $proveedor->Localidad = $request->localidad;
        $proveedor->Provincia = $request->provincia;
        //Se actualizan los datos en la BD
        $proveedor->update();
        //Regresa a la vista de consultas
        return redirect()->route('gestionProveedores.menu');
    }


}
