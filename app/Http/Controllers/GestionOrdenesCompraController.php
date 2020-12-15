<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GestionOrdenesCompraController extends Controller
{
    public function index(){
        return view('/gestionCompras/ordenes/menu');
      }
}
