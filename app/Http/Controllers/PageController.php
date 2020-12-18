<?php

namespace App\Http\Controllers;

use App\Models\Solicitud_Compras;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
        
    }

    public function create(){

    }

    public function construction(){
        return view('construction');
    }

    public function gestionUsuarios(){
        //validar que sea Super_Usuario
      $this->authorize('consultar', User::class);
        return view('/gestionUsuarios/menuUsuarios');
    }

    public function gestionArticulos(){
        //validar que sea Super_Usuario
        $this->authorize('consultar', Articulo::class);
        return view('/gestionArticulos/menuArticulos');
    }

    public function gestionProveedores(){
        //validar que sea Super_Usuario
        $this->authorize('consultar', Proveedor::class);
        return view('/gestionProveedores/menuProveedores');
    }

    public function gestionInventario(){
        //validar que sea Super_Usuario
        $this->authorize('consultar', Articulo::class);
        return view('/gestionInventario/menuInventario');
    }

    public function gestionCompras(){
        //validar que sea Super_Usuario
        return view('/gestionCompras/menuCompras');
    }

}
