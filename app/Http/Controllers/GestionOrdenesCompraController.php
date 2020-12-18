<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Orden_Compra;
use Illuminate\Support\Facades\Auth;
use App\Models\Estado_Orden_Compra;

class GestionOrdenesCompraController extends Controller
{
    public function index(){
      //validar que sea Super_Usuario
      $this->authorize('consultar', Orden_Compra::class);
      $ordenes = DB::table('ordenes_compras')
      ->join('estados_ordenes_compras','estados_ordenes_compras.OrdenCompraID','=','ordenes_compras.OrdenCompraID')
      ->join('presupuestos','presupuestos.PresupuestoID','=','ordenes_compras.PresuID')
      ->join('proveedores','proveedores.ProveedorID','=','presupuestos.ProveID')
      ->where('EstadoID','Pendiente')
      ->get();       

      return view('/gestionCompras/ordenes/menu')
      ->with('ordenes',$ordenes);
    }

    public function verDetalle($idOC){
      //validar que sea Super_Usuario
      $this->authorize('consultar', Orden_Compra::class);

      $detalle = DB::table('ordenes_compras')
      ->join('detalles_orden_compra','detalles_orden_compra.OrdenCompraID','=','ordenes_compras.OrdenCompraID')
      ->join('articulos','articulos.ArticuloID','=','detalles_orden_compra.ArticuloID')
      ->where('ordenes_compras.OrdenCompraID',$idOC)
      ->get();

      $proveID = DB::table('ordenes_compras')
      ->join('presupuestos','presupuestos.PresupuestoID','=','ordenes_compras.PresuID')
      ->where('ordenes_compras.OrdenCompraID', $idOC)
      ->value('ProveID');    

      $estado = DB::table('estados_ordenes_compras')
      ->where('estados_ordenes_compras.OrdenCompraID',$idOC)
      ->get();
     
      $estado_algo = $estado[0]->EstadoID;

      if(count($estado) > 1)
        if($estado[1]->EstadoID == 'Rechazada' || $estado[1]->EstadoID == 'Aprobada')
          $estado_algo= $estado[1]->EstadoID;
  

      $proveedor = DB::table('proveedores')
      ->where('proveedores.ProveedorID',$proveID)
      ->value('proveedores.Razon_social');
      
      //Se calculan los subtotales del detalle para enviarlos a la vista
      $subtotal = array();
      $n = count($detalle);
      for($i=0; $i<$n; $i++){
        $subtotal[$i] = $detalle[$i]->Cantidad * $detalle[$i]->PrecioUnitario;
        if($detalle[$i]->Descuento != 0)
          $subtotal[$i] -=  ($subtotal[$i] * $detalle[$i]->Descuento)/100;
      }   

      return view('/gestionCompras/ordenes/detalleOrdenCompra')
      ->with('detalle',$detalle)
      ->with('proveedor', $proveedor)
      ->with('subtotal', $subtotal)
      ->with('estado', $estado_algo);
    }

    /**
     * Función evalua la aprobación de una orden de compra dependiendo del usuario que se encuentra logueado
     * y del monto total de la orden de compra.
     */
    public function aprobar(Request $request){
      //validar que sea Super_Usuario
      $this->authorize('modificar', Orden_Compra::class);
      //Se recupera la orden de compra de id idOC
      $orden= Orden_Compra::find($request->id);

      //Se recupera el id del usuario logueado y se consulta su rol de usuario
      $id_user =Auth::id();
      $rol_usuario = DB::table('usuarios_roles')
      ->where('UsuarioID',$id_user)
      ->get();
 
      $isUser='';
     foreach($rol_usuario as $r){
          if(($r->RolID=='Administrador_de_Compras')and ($isUser!='Directivo')){
              $isUser='Administrador_de_Compras';
          }else{
              if($r->RolID=='Directivo'){
                $isUser='Directivo';
            }
          }

        }
      //Se verifica si el usuario logueado es el administrador de compras y el monto total de la compra es menor a $ 30.000
      if(($isUser=='Administrador_de_Compras')){
        if($orden->Total <= 30000){         
          //Se crea el estado de la orden de compra
          $estado_orden_compra = new Estado_Orden_Compra();
          $estado_orden_compra->EstadoID = 'Aprobada';
          $estado_orden_compra->OrdenCompraID = $orden->OrdenCompraID;
          $estado_orden_compra->AdminComprasID=Auth::id();
          $estado_orden_compra->FechaHora = date("Y-n-j"); 
          $estado_orden_compra->IDAprobador=Auth::id();
          $estado_orden_compra->save();
          
          DB::table('estados_ordenes_compras')
          ->where('EstadoID','Pendiente')
          ->where('OrdenCompraID',$orden->OrdenCompraID)
          ->update(['IDAprobador'=>Auth::id()]);

          /*$estado = DB::table('estados_ordenes_compras')
          ->where('estados_ordenes_compras.OrdenCompraID',$orden->OrdenCompraID)
          ->whereNotNull('IDAprobador')
          ->value('EstadoID');*/
      
          return redirect()->route('compras.ordenes')->with('success','Se ha aprobado una Órden de Compra.');
        }
        else
          //return "redicionar con mensaje de error";
          //Se retorna a la vista del menu de ordenes de compras
          return redirect()->route('compras.ordenes.verDetalle',$orden->OrdenCompraID)->with('error','El monto total de la Órden de Compra excede su disponibilidad de evaluación.');
      }else{
              if($isUser == 'Directivo'){
                //Se crea el estado de la orden de compra
                $estado_orden_compra = new Estado_Orden_Compra();
                $estado_orden_compra->EstadoID = 'Aprobada';
                $estado_orden_compra->OrdenCompraID = $orden->OrdenCompraID;
                $estado_orden_compra->AdminComprasID=Auth::id();
                $estado_orden_compra->FechaHora = date("Y-n-j"); 
                $estado_orden_compra->IDAprobador=Auth::id();
                $estado_orden_compra->save();

                DB::table('estados_ordenes_compras')
                ->where('EstadoID','Pendiente')
                ->where('OrdenCompraID',$orden->OrdenCompraID)
                ->update(['IDAprobador'=>Auth::id()]);             
            
                return redirect()->route('compras.ordenes')->with('success','Se ha aprobado una Orden de Compra.');
            }else{
              return view('/errors/403');
            }
          
      }

      
    }


    
    /**
     * Función evalua el rechazo de una orden de compra dependiendo del usuario que se encuentra logueado
     * y del monto total de la orden de compra.
     */
    public function rechazar(Request $request){
      //validar que sea Super_Usuario
      $this->authorize('modificar', Orden_Compra::class);
      //Se recupera la orden de compra de id idOC
      $orden= Orden_Compra::find($request->id);

       //Se recupera el id del usuario logueado y se consulta su rol de usuario
       $id_user =Auth::id();
      $rol_usuario = DB::table('usuarios_roles')
      ->where('UsuarioID',$id_user)
      ->get();
 
      $isUser='';
     foreach($rol_usuario as $r){
          if(($r->RolID=='Administrador_de_Compras')and ($isUser!='Directivo')){
              $isUser='Administrador_de_Compras';
          }else{
              if($r->RolID=='Directivo'){
                $isUser='Directivo';
            }
          }

      }
      //Se verifica si el usuario logueado es el administrador de compras
      if(($isUser == 'Administrador_de_Compras') or ($isUser == 'Directivo') ){              
          //Se crea el estado de la orden de compra
          $estado_orden_compra = new Estado_Orden_Compra();
          $estado_orden_compra->EstadoID = 'Rechazada';
          $estado_orden_compra->OrdenCompraID = $orden->OrdenCompraID;
          $estado_orden_compra->AdminComprasID=Auth::id();
          $estado_orden_compra->FechaHora = date("Y-n-j"); 
          $estado_orden_compra->IDAprobador=Auth::id();
          $estado_orden_compra->save();
          
          DB::table('estados_ordenes_compras')
          ->where('EstadoID','Pendiente')
          ->where('OrdenCompraID',$orden->OrdenCompraID)
          ->update(['IDAprobador'=>Auth::id()]);     
      
          return redirect()->route('compras.ordenes')->with('success','Se ha rechazado una Orden de Compra.');     
      }
      return view('/errors/403');
    }
}
