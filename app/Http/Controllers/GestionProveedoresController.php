<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;

class GestionProveedoresController extends Controller
{
    
    public function menu(){
         //validar que este autorizado para la consulta
        $this->authorize('consultar', Proveedor::class);
        $proveedores = Proveedor::all();
        return view('gestionProveedores/menu')
        ->with('proveedores',$proveedores);    
     }

    //Almacena los datos del formulario
    public function alta( Request $request){ 
        //validar que este autorizado para el Alta
        $this->authorize('alta', Proveedor::class);
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
        //validar que este autorizado para la Baja
        $this->authorize('baja', Proveedor::class);          
   
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
         //validar que este autorizado para la Modificación
         $this->authorize('modificar', Proveedor::class);   
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
        return redirect()->route('gestionProveedores.menu')->with('success','Proveedor actualizado exitosamente.'); 
    }


}
