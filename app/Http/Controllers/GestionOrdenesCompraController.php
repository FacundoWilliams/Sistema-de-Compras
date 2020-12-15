<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GestionOrdenesCompraController extends Controller
{
    public function index(){
      $ordenes = DB::table('ordenes_compras')
      ->join('estados_ordenes_compras','estados_ordenes_compras.OrdenCompraID','=','ordenes_compras.OrdenCompraID')
      ->join('presupuestos','presupuestos.PresupuestoID','=','ordenes_compras.PresuID')
      ->join('proveedores','proveedores.ProveedorID','=','presupuestos.ProveID')
      ->where('EstadoID','Pendiente')
      ->get();      

      return view('/gestionCompras/ordenes/menu')
      ->with('ordenes',$ordenes);
    }

}
