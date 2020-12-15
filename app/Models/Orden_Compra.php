<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orden_Compra extends Model
{ 
    use HasFactory;
    protected $table="ordenes_compras";
    //Vinculo con la clave primaria de la tabla
    protected $primaryKey=('OrdenCompraID');
    public $timestamps = false;//inhabilita los timestamps
}
