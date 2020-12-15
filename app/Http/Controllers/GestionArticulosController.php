<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articulo;
use App\Models\Articulo_Proveedor;
use Illuminate\Support\Facades\DB;
use App\Models\Proveedor;

class GestionArticulosController extends Controller
{
   public $dir='';

   /*public function direccionar($path){
      $this->path = $path;
      switch($this->path){
         case "menu":
            $this->dir = 'gestionArticulos.';
         break;

         case "puntoPedido" || "ajustarInventario" || "registrarRecepcion" || "verificarInventario":
            $this->dir='gestionInventario.';
         break;
      } 
      $this->path = $this->dir.$this->path;
      $articulos = Articulo::all();
      return view($this->path)
      ->with('articulos',$articulos);  
   }*/

   public function menu(){
      $articulos = Articulo::all();
      return view('gestionArticulos/menu')
      ->with('articulos',$articulos);    
   } 

   public function puntoPedido(){
      $articulos = Articulo::all();
      return view('gestionInventario/puntoPedido')
      ->with('articulos',$articulos);    
   }

   public function ajustarInventario(){
      $articulos = Articulo::all();
      return view('gestionInventario/ajustarInventario')
      ->with('articulos',$articulos);    
   }

   public function registrarRecepcion(){
      $articulos = Articulo::all();
      return view('gestionInventario/registrarRecepcion')
      ->with('articulos',$articulos);    
   }

   public function verificarInventario(){
      $articulos = Articulo::all();
      return view('gestionInventario/verificarInventario')
      ->with('articulos',$articulos);    
   }

   //Almacena los datos del formulario
   public function alta(Request $request){
      $articulo = new Articulo();
      $articulo->Descripcion =$request->descripcion;
      $articulo->Tipo_embalaje =$request->tipo_embalaje;
      $articulo->Unidad_medida =$request->unidad_medida;
      $articulo->Unidad_bulto =$request->unidad_bulto+0;
      $articulo->Punto_pedido =$request->punto_pedido+0;
      $articulo->Stock_disponible =$request->stock_disponible+0;
      $articulo->Activo=1;
      //Se guardan los datos en la BD
      $articulo->save();
      //Regresa a la vista de consultas
      return redirect()->route('gestionArticulos.menu')->with('success','Artículo registrado exitosamente');
   
   }

   /**
    * Función que edita un articulo existente, actualiza la base de datos y retorna la vista al menu principal. 
    */
   public function editar(Request $request){        
      $articulo = Articulo::find($request->id);
      $articulo->Descripcion =$request->descripcion;
      $articulo->Tipo_embalaje =$request->tipo_embalaje;
      $articulo->Unidad_medida =$request->unidad_medida;
      $articulo->Unidad_bulto =$request->unidad_bulto;
      $articulo->Stock_disponible =$request->stock;
      $articulo->Punto_pedido =$request->punto_pedido;
      //Se guardan los datos en la BD
      $articulo->update();
      //Regresa a la vista de consultas
      return redirect()->route('gestionArticulos.menu');
   }

   /**
    * Función que elimina de manera lógica un articulo siempre que el mismo no tenga proveedores vinculados,
    * esta condición permite asegurar que no se eliminen artículos con proveedores vinculados lo cual es 
    * condición necesaria para que se genere una solicitud de compra
    */
   public function eliminar(Request $request){        
      //$articulo = Articulo::find($request->id);
      $articulo = DB::table('articulos')
      ->join('articulo_proveedor','articulos.ArticuloID','=','articulo_proveedor.ArticuloID')
      ->where('articulos.ArticuloID',$request->id)
      ->where('articulos.Activo',1)
      ->get();

      return $articulo;

      $articulo->Activo=0;
      //Se guardan los datos en la BD
      $articulo->update();
      //Regresa a la vista de consultas
      return redirect()->route('gestionArticulos.menu')->with('success','Artículo eliminado exitosamente');
   }

   /**
    * Funcion que se encarga de asignar proveedores para un Articulo determinado
    * Argumentos.
    * articuloID: ID del artículo al cual se le quiere asignar proveedores.
    * request: proveedores seleccionados a asignar al articulo.
    */
   public function asignarProveedor(Request $request, $articuloID){            
       //obtengo los datos que necesito año-mes-dia
       $tiempo=getdate();
       $fechahoy=$tiempo['year'].'-'. $tiempo['mon'].'-'.$tiempo['mday'];
      //Se recorren todos los id de proveedores recibidos en el request a partir de la selección de proveedores.
      foreach ($request->id as $proveedorID){
         $vinculo = DB::table('articulo_proveedor')      
         ->where('ArticuloID',$articuloID)       
         ->where('ProveedorID',$proveedorID)
         ->get();
         //Se verifica si la colección recuperada en la consulta es vacia, en este caso no existe registro y se debe crear
         if(($vinculo)->isEmpty()){
            $articuloProveedor = new Articulo_Proveedor();
            $articuloProveedor->ProveedorID =$proveedorID;
            $articuloProveedor->articuloID =$articuloID;
            $articuloProveedor->FechaDesde= $fechahoy;
            $articuloProveedor->FechaHasta=NULL;
            //Se guardan los datos en la BD
            $articuloProveedor->save();                    
         }
         //Se verifica si la colección recuperada en la consulta no es vacia, en este caso existe el registro y se debe actualizar
         else{
            DB::table('articulo_proveedor')
            ->where('ArticuloID',$articuloID)       
            ->where('ProveedorID',$proveedorID) 
            ->update(['FechaDesde'=> $fechahoy,'FechaHasta'=>NULL]);       
         }         
      }

      //Regresa a la vista de consultas
      return redirect()->route('gestionArticulos.menu');
   }

   
   /**
    * Funcion que se encarga de desasignar proveedores para un Articulo
    */
    public function desasignarProveedor(Request $request, $articuloID){
       //obtengo los datos que necesito año-mes-dia
       $tiempo=getdate();
       $fechahoy=$tiempo['year'].'-'. $tiempo['mon'].'-'.$tiempo['mday'];
      foreach ($request->id as $proveedorID){
         DB::table('articulo_proveedor')
         ->where('ArticuloID',$articuloID)       
         ->where('ProveedorID',$proveedorID)      
         ->update(['FechaHasta'=>$fechahoy]); 
      }
      //Regresa a la vista de consultas
      return redirect()->route('gestionArticulos.menu');
   }

  /**
   * Función que recibe un articulo seleccionado por el usuario y redirige a la vista correspondientes
   * con todos los proveedores posibles que se pueden vincular a dicho artículo.
   */
   public function vincularProveedor($ArticuloID){
      $articulo = Articulo::find($ArticuloID); 
      $proveedores = Proveedor::all();
      return view('/gestionArticulos/articulos/vincularProveedor')
      ->with('articulo',$articulo)
      ->with('proveedores' ,$proveedores);
   }

   /**
    * Función que recibe un artículo seleccionado por el usuario y redirige a la vista correspondiente
    * con todos los proveedores vinculados para tal artículo.
    */
   public function desvincularProveedor($ArticuloID){
      $articulo = Articulo::find($ArticuloID); 
      //Recupera una lista de los proveedores vinculados con el articulo recibido de la tabla articulo_proveedor
      $proveedores= DB::table('proveedores')
      ->join('articulo_proveedor','proveedores.ProveedorID','=','articulo_proveedor.ProveedorID')
      ->select('proveedores.ProveedorID','proveedores.Nombre','proveedores.Razon_social')
      ->where('ArticuloID',$ArticuloID)
      ->where('FechaHasta',NULL)      
      ->get();
      return view('/gestionArticulos/articulos/desvincularProveedor')
      ->with('articulo',$articulo)
      ->with('proveedores' ,$proveedores);   
   }


   /**
   * Función que recibe información a través de un post desde un formulario de la vista de inventario,
   * recupera el articulo de la tabla articulos con el ArticuloID enviado y actualiza el campo de
   * punto de pedido del articulo con el valor del nuevo punto de pedido.
   */
   public function establecer(Request $request){              
      $articulo = Articulo::find($request->id);
      $articulo->Punto_pedido = $request->punto_pedido_nuevo;        
      //Se actualizan los datos en la BD
      $articulo->update();
      //Regresa a la vista de punto de pedido
      return redirect()->route('gestionInventario.puntoPedido');    
   }

    
   
   /**
   * Función que recibe información a través de un post desde un formulario de la vista de inventario,
   * recupera el articulo de la tabla articulos con el ArticuloID enviado y actualiza el campo de
   * stock disponible del articulo con el valor recicibo de ajuste.
   */
   public function ajustar(Request $request){        
      $articulo = Articulo::find($request->id);      
      $articulo->Stock_disponible += $request->ajuste;         
      //Se actualizan los datos en la BD
      $articulo->update();      
      // Regresa a la vista de ajuste de inventario si se encontraba en ella, de lo contrario regresa a la vista de recepción de articulos 
      if ($request->ajuste < 0) {
         return redirect()->route('gestionInventario.ajustarInventario'); 
      } else {
         return redirect()->route('gestionInventario.registrarRecepcion'); 
      }        
   }

     

}

