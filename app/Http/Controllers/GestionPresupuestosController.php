<?php

namespace App\Http\Controllers;

use App\Models\Detalle_Orden_Compra;
use App\Models\Detalle_Presupuesto;
use App\Models\Detalle_Solicitud_Presupuesto;
use App\Models\Estado_Orden_Compra;
use App\Models\Estado_Presupuestos;
use Illuminate\Http\Request;
use App\Models\Solicitud_Compras;
use App\Models\Solicitud_Presupuesto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Estado_Solicitud_Compras;
use App\Models\Orden_Compra;
use App\Models\Presupuesto;
use App\Models\Solicitud_Presupuesto_Proveedor;

class GestionPresupuestosController extends Controller
{
    public function index(){
      $solicitudes = DB::table('solicitud_compras')
      ->join('estados_solicitud_compras','estados_solicitud_compras.SolicitudCompraID','=','solicitud_compras.SolicitudCompraID')
      ->where('EstadoID','Pendiente')->get();
      return view('/gestionCompras/presupuestos/menu')
      ->with('solicitudes' ,$solicitudes);  
    }
    
    public function solicitudesPresupuesto($solicitud){
      $fecha = DB::table('solicitud_compras')
      ->where('SolicitudCompraID',$solicitud)->value('FechaRegistro');      

      $estado = DB::table('estados_solicitud_compras')
      ->where('SolicitudCompraID',$solicitud)->value('EstadoID');
    
      $solpresupuestos = DB::table('solicitudes_presupuestos')
      ->join('deta_soli_presu','deta_soli_presu.SoliPresuID',"=","SolicitudPresupuestoID")
      ->join('proveedores','proveedores.ProveedorID','=','deta_soli_presu.ProveID')
      ->leftJoin('presupuestos','presupuestos.SoliPresuID','=','solicitudes_presupuestos.SolicitudPresupuestoID')
      ->where('SolicitudCompraID',$solicitud)     
      ->get();

      $unicos = $solpresupuestos->unique('SolicitudPresupuestoID');

      //return $unicos;
      
      return view('/gestionCompras/presupuestos/solicitudesPresupuesto')
      ->with('solpresupuestos' ,$unicos)
      ->with('estado', $estado)
      ->with('solicitud', $solicitud)
      ->with('fecha', $fecha);
    }

    public function solicitarPresupuesto($solicitud){
      $art=array();
      //Obtengo los articulos que tienen proveedores vinculados
      $artSolicitados = DB::table('detalles_solicitud_compras')
      ->join('articulos','detalles_solicitud_compras.ArticuloID','=','articulos.ArticuloID')
      ->join('articulo_proveedor','detalles_solicitud_compras.ArticuloID','=','articulo_proveedor.ArticuloID')
      ->join('proveedores','articulo_proveedor.ProveedorID','=','proveedores.ProveedorID')
      ->where('SolicitudCompraID',$solicitud)->get();
      
      //Obtengo los articulos de ls detalles de solciitudes de Presupuestos
      $art_exist= DB::table('deta_soli_presu')
      ->join('articulos','deta_soli_presu.ArtiID','=','articulos.ArticuloID')
      ->join('solicitudes_presupuestos','solicitudes_presupuestos.SolicitudPresupuestoID','=','deta_soli_presu.SoliPresuID')
      ->where('SolicitudCompraID',$solicitud)->get();
      
      //recorro para los articulos vinculados a proveedores y quito los que ya esten solicitados 
      $i=0;
      foreach($artSolicitados as $t){
        $j=0;
        $b=true;
        while($b and ($j<count($art_exist))){
          if(($t->ArticuloID == $art_exist[$j]->ArtiID)and($t->ProveedorID == $art_exist[$j]->ProveID)){
            $b=false;
          }
          $j++;
        }
        if($b){
          $art[$i]=$t;
          $i++;
        }
      }
      
      return view('/gestionCompras/presupuestos/solicitarPresup')
      ->with('artSolicitados' ,$art)
      ->with('solicitud', $solicitud);
    }


    public function registrarSolicitud(Request $request, $solicitud){
    //redirige a la vista de solicitudes de Presupuesto, si no existen arituclos a solicitar
     if($request->id==null){
      //aca va la alerta que indicara que no hay mas articulos a asolicitar
      return redirect()->route('compras.presupuestos');
    }
    //ordenamiento de los detalles por ID proveedore, guardandos sus correspondientes datos
     $proveedores=array();
     $id=array();
     $cantidades=array();
     $fps=array();

     $proveedores=$request->proveedores;
     $id=$request->id;
     $cantidades=$request->cantidades;
     $fps=$request->fps;
     
     $n=count($proveedores);
     for ($i=0; $i< $n-1; $i++)
     {
           $min=$i;
           for($j=$i+1; $j<$n; $j++)
                 if($proveedores[$min] > $proveedores[$j])
                    $min=$j;
           $aux=$proveedores[$min];
           $auxa=$id[$min];
           $auxc=$cantidades[$min];
           $auxf=$fps[$min];
           
           $id[$min]=$id[$i];
           $cantidades[$min]=$cantidades[$i];
           $fps[$min]=$fps[$i];
           $proveedores[$min]=$proveedores[$i];

           $proveedores[$i]=$aux;
           $id[$i]=$auxa;
           $cantidades[$i]=$auxc;
           $fps[$i]=$auxf;
     }
 //Fin Ordenamineto de proveedores
     
     
     
  //registrar estado=Procesado para la solicitud de Compra, además de agregar el AdminID
  //recuperar Solicitud e ingresa el AdminID que lo reviso
     DB::table('estados_solicitud_compras')
            ->where('SolicitudCompraID',$solicitud)
            ->where('EstadoID','Pendiente')
            ->update(['AdminComprasID'=>Auth::id()]);

      $sol = DB::table('estados_solicitud_compras')
            ->where('SolicitudCompraID',$solicitud)
            ->where('EstadoID','Pendiente')->get();
      
      $sol_p_exist=DB::table('estados_solicitud_compras')
      ->where('SolicitudCompraID',$solicitud)
      ->where('EstadoID','Procesado')->value('SolicitudCompraID');
         
        if(empty($sol_p_exist)){
        $estadoSol= new Estado_Solicitud_Compras();
        //Creo nuevo estado para la Solicitud de Compras "Procesado"
        $estadoSol->SolicitudCompraID=$solicitud;
        $estadoSol->EstadoID='Procesado';
        $estadoSol->FechaHora=date("Y-n-j");
        //Obtener ID del usuario actualmente logueado
        $estadoSol->ResponsableID=$sol[0]->ResponsableID;
        $estadoSol->AdminComprasID=$sol[0]->AdminComprasID;
        //guardar nuevo estado procesado       
        $estadoSol->save();
      }
     
     
      //creamos la solicitud de Presupuesto
      $solpresupuesto=new Solicitud_Presupuesto();
      $solpresupuesto->FechaRegistro=date("Y-n-j");
      $solpresupuesto->AdminComprasID=Auth::id();
      $solpresupuesto->SolicitudCompraID=$solicitud;
      //guardamos solicitud de Presupuesto
      $solpresupuesto->save();

      //Se recupera el ID Solicitud de Presupuesto Recien Creada
      $solP = DB::table('solicitudes_presupuestos')->max('SolicitudPresupuestoID');

      

      $i=0;
      $prov_a=$proveedores[0];
      foreach($proveedores as $p){
        if($prov_a!=$p){//Condicional que crea otra Solicitud de Presupuesto para agrupar los que tengan el mismo proveedor
          //creamos la solicitud de Presupuesto
          $solpresupuesto=new Solicitud_Presupuesto();
          $solpresupuesto->FechaRegistro=date("Y-n-j");
          $solpresupuesto->AdminComprasID=Auth::id();
          $solpresupuesto->SolicitudCompraID=$solicitud;
          //guardamos solicitud de Presupuesto
          $solpresupuesto->save();

          //Se recupera el ID Solicitud de Presupuesto Recien Creada
          $solP = DB::table('solicitudes_presupuestos')->max('SolicitudPresupuestoID');
          $prov_a=$p;
        }

        //crear un Detalle de Solicitud de Presupuesto
        $det_sol_pres= new Detalle_Solicitud_Presupuesto();
        $det_sol_pres->ArtiID=$id[$i];
        $det_sol_pres->SoliPresuID=$solP;
        $det_sol_pres->ProveID=$p;
        $det_sol_pres->FechaReposicion=$fps[$i];
        $det_sol_pres->Cantidad=$cantidades[$i];
        //guardar
        $det_sol_pres->save();
        $i++;
      }
      

      return redirect()->route('compras.presupuestos');
    
    }

    public function detallePresuSolicitado($idSol){
      $sol = DB::table('solicitudes_presupuestos')
      ->join('users','solicitudes_presupuestos.AdminComprasID','=','users.id')
      ->where('SolicitudPresupuestoID',$idSol)->get();

      $detalle = DB::table('deta_soli_presu')
      ->join('articulos','deta_soli_presu.ArtiID','=','articulos.ArticuloID')
      ->where('SoliPresuID',$idSol)->get();
    
      return view('/gestionCompras/presupuestos/detalle')
      ->with('sol',$idSol)
      ->with('solicitud',$sol[0])
      ->with('detalle',$detalle);
    }

    /**
     * Función que recupera los datos de detalle de un presupuesto registrado.
     */
    public function detallePresuRegistrado($idPresu){
      //Se recuperan los datos del detalle del presupuesto registrado con el ID $idPresu
      $presu = DB::table('presupuestos')
      ->join('detalles_presupuestos','detalles_presupuestos.PresupuestoID','=','presupuestos.PresupuestoID')
      ->join('articulos','articulos.ArticuloID','=','detalles_presupuestos.ArticuloID')
      ->where('presupuestos.PresupuestoID',$idPresu)->get();

      //Se calculan los subtotales del detalle para enviarlos a la vista
      $subtotal = array();
      $n = count($presu);
      for($i=0; $i<$n; $i++){
        $subtotal[$i] = $presu[$i]->Cantidad * $presu[$i]->PrecioUnitario;
        if($presu[$i]->Descuento != 0)
          $subtotal[$i] -=  ($subtotal[$i] * $subtotal[$i]->Descuento)/100;
      }     

      //Se recuperan los datos del proveedor del presupuesto registrado con el ID $idSol
      $prove = DB::table('presupuestos')
      ->join('proveedores','proveedores.ProveedorID','=','presupuestos.ProveID')
      ->where('presupuestos.PresupuestoID',$idPresu)
      ->get();

      //Se recupera el dato de la Solicitud de Compra relacionada con el presupuesto para retornar a la vista correspondiente
      $idSol = DB::table('presupuestos')
      ->join('solicitudes_presupuestos','solicitudes_presupuestos.SolicitudPresupuestoID','=','presupuestos.SoliPresuID')
      ->where('presupuestos.PresupuestoID',$idPresu)
      ->value('SolicitudCompraID');

      return view('/gestionCompras/presupuestos/detallePresupuesto')
      ->with('prove',$prove)
      ->with('detalle',$presu)
      ->with('idSol',$idSol)
      ->with('subtotal',$subtotal);
    }

    public function altaPresupuesto($idSol){
      $detalle = DB::table('deta_soli_presu')
      ->join('proveedores','proveedores.ProveedorID','=','deta_soli_presu.ProveID')
      ->join('articulos','articulos.ArticuloID','=','deta_soli_presu.ArtiID')
      ->where('deta_soli_presu.SoliPresuID',$idSol)->get();           
      $solCompra = DB::table('solicitudes_presupuestos')
      ->where('solicitudes_presupuestos.SolicitudPresupuestoID',$idSol)
      ->value('SolicitudCompraID');
      return view('/gestionCompras/presupuestos/alta')
      ->with('detalle',$detalle)
      ->with('solCompra',$solCompra);
    }

    public function registrarPresupuesto(Request $request, $idSol){
      //return $request;
      //Se crea el presupuesto en la BD 
      $presupuesto = new Presupuesto();
      $presupuesto->NroPresupuesto=$request->presuNro;
      $presupuesto->FechaRegistro=date("Y-n-j");
      $presupuesto->FechaValidez=$request->fechaVal;
      $presupuesto->FechaEntregaEstimada=$request->fechaVal;
      $presupuesto->ProveID=$request->proveID;
      $presupuesto->SoliPresuID=$idSol;     
      $n=count($request->cantidad);
      $subtotal = 0;
      for ($i=0; $i < $n ; $i++){
          $subtotal += $request->cantidad[$i] * $request->precioUni[$i];
        if($request->descuento[$i] != 0)
          $subtotal -=  ($subtotal * $request->descuento[$i])/100;
      }
      $presupuesto->Total = $subtotal;
      $presupuesto->save();

      //Se crea el estado del presupuesto en la BD
      $estado_presupuesto = new Estado_Presupuestos();
      $estado_presupuesto->EstadoID = 'Pendiente';
      $estado_presupuesto->PresupuestoID = DB::table('presupuestos')->max('PresupuestoID');
      $estado_presupuesto->AdminComprasID=Auth::id();
      $estado_presupuesto->FechaHora=date("Y-n-j");
      $estado_presupuesto->save();

      $solCompra = DB::table('solicitudes_presupuestos')
      ->where('solicitudes_presupuestos.SolicitudPresupuestoID',$idSol)
      ->value('SolicitudCompraID');

      //Se crea el detalle del presupuesto en la BD para cada artículo
      $articulos=count($request->artID);
      for ($i=0; $i < $articulos ; $i++){
        $detalle_presupuesto = new Detalle_Presupuesto();
        $detalle_presupuesto->PresupuestoID = DB::table('presupuestos')->max('PresupuestoID');
        $detalle_presupuesto->ArticuloID = $request->artID[$i];
        $detalle_presupuesto->Cantidad = $request->cantidad[$i];
        $detalle_presupuesto->PrecioUnitario = $request->precioUni[$i];
        $detalle_presupuesto->Descuento = $request->descuento[$i];
        $detalle_presupuesto->save();
      }
      //return redirect()->route('compras.presupuestos.solicitudes',$solCompra)->with('success','Presupuesto registrado exitosamente.');
      //Se retorna a la vista de presupuestos registrados
      return redirect()->route('compras.presupuestos.registrados',$solCompra)->with('success','Presupuesto registrado exitosamente.');

    }

    /**
     * Función que recible el ID de una solicitud de Compra, recupera los presupuestos registrados vinculados con
     * esa solicitud de compra y retorna la información a la vista correspondiente
     */
    public function presupuestosRegistrados($idSol){
      //Se recuperan todos los presupuestos registrados en respuesta a cada solicitud de presupuestos asociados con esta solicitud de compra
      $presu_regi = DB::table('solicitudes_presupuestos')
      ->join('presupuestos','presupuestos.SoliPresuID','=','solicitudes_presupuestos.SolicitudPresupuestoID')
      ->join('proveedores','proveedores.ProveedorID','=','presupuestos.ProveID')
      ->where('solicitudes_presupuestos.SolicitudCompraID',$idSol)
      ->get();

      //Se recupera la Solicitud de Compra con los datos del usuario que la creo para retornar a la vista y visualizar información detallada
      $solCompra = DB::table('solicitud_compras')
      ->join('estados_solicitud_compras','estados_solicitud_compras.SolicitudCompraID','=','solicitud_compras.SolicitudCompraID')
      ->join('users','users.id','=','estados_solicitud_compras.ResponsableID')
      ->where('solicitud_compras.SolicitudCompraID',$idSol)
      ->get();

      //return $presu_regi;
      //Se retorna a la vista con los datos recuperados
      return view('/gestionCompras/presupuestos/presupuestosRegistrados')
      ->with('presu_regi',$presu_regi)
      ->with('solCompra',$solCompra);
    }

    /**
     * Función que recupera los datos de detalle de un presupuesto registrado y los retorna a la vista correspondiente
     * para la posterior seleccion.
     */
    public function seleccionPresuRegistrado($idPresu){
      //Se recuperan los datos del detalle del presupuesto registrado con el ID $idPresu
      $presu = DB::table('presupuestos')
      ->join('detalles_presupuestos','detalles_presupuestos.PresupuestoID','=','presupuestos.PresupuestoID')
      ->join('articulos','articulos.ArticuloID','=','detalles_presupuestos.ArticuloID')
      ->where('presupuestos.PresupuestoID',$idPresu)
      ->where('detalles_presupuestos.FechaHoraSeleccion',null)->get();
      
      //Se recuperan los datos del proveedor del presupuesto registrado con el ID $idPresu
      $prove = DB::table('presupuestos')
      ->join('proveedores','proveedores.ProveedorID','=','presupuestos.ProveID')
      ->where('presupuestos.PresupuestoID',$idPresu)
      ->get();

      //Se calculan los subtotales del detalle para enviarlos a la vista
      $subtotal = array();
      $n = count($presu);
      for($i=0; $i<$n; $i++){
        $subtotal[$i] = $presu[$i]->Cantidad * $presu[$i]->PrecioUnitario;
        if($presu[$i]->Descuento != 0)
          $subtotal[$i] -=  ($subtotal[$i] * $subtotal[$i]->Descuento)/100;
      }     

      return view('/gestionCompras/presupuestos/seleccionPresupuesto')
      ->with('prove',$prove)
      ->with('detalle',$presu)
      ->with('idPresu',$idPresu)
      ->with('subtotal',$subtotal);
    }


    /**
     * Función que recibe el detalle seleccionado de un presupuesto registrado, crea la orden de compra y su correspondiente 
     * detalle.
     */
    public function seleccionarDetallePresupuestoRegistrado(Request $request){
      //Se controla que si no se seleccionaron articulos, no se debe crear una orden de compra, se debe alertar al usuario y retornar a la vista actual
      if($request->id == NULL)
        return redirect()->route('compras.presupuestosRegistrados.seleccionPresuRegistrado',$request->presupuesto)->with('error','No se seleccionaron artículos para comprar.');
      
      //Se recupera el ID de la solicitud de compra vinculado con el presupesto registrado
      $solCompra = DB::table('presupuestos')
      ->join('solicitudes_presupuestos','solicitudes_presupuestos.SolicitudPresupuestoID','=','presupuestos.SoliPresuID')
      ->where('PresupuestoID',$request->presupuesto)
      ->value('SolicitudCompraID');
      
      $total=0;
      //Reccorre array de articulos seleccionados

      //Se crea la orden de compra
      $orden_compra = new Orden_Compra();
      $orden_compra->FechaRegistro = date("Y-n-j");      
      $orden_compra->Total = $total;
      $orden_compra->PresuID = $request->presupuesto;
      $orden_compra->SoliCompraID = $solCompra;      
      $orden_compra->save();


      //Se crea el estado de la orden de compra
      $estado_orden_compra = new Estado_Orden_Compra();
      $estado_orden_compra->EstadoID = 'Pendiente';
      $estado_orden_compra->OrdenCompraID = DB::table('ordenes_compras')->max('OrdenCompraID');
      $estado_orden_compra->AdminComprasID=Auth::id();
      $estado_orden_compra->FechaHora = date("Y-n-j"); 
      $estado_orden_compra->save();
         
      //Se crea el detalle de la orden de compra
      $n = count($request->id);
      for($i=0; $i < $n; $i++){
        $detalle_orden_compra = new Detalle_Orden_Compra();
        $detalle_orden_compra->ArticuloID = $request->id[$i];
        $detalle_orden_compra->OrdenCompraID = DB::table('ordenes_compras')->max('OrdenCompraID');
        $detalle_orden_compra->Cantidad = $request->cantidad[$i];
        $detalle_orden_compra->PrecioUnitario = $request->precioUni[$i];
        $detalle_orden_compra->save();
      }    

      //Se retorna a la vista del menu de ordenes de compras
      return redirect()->route('compras.ordenes')->with('success','Se ha creado una orden de compra.');
    }

}
