<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud_Compras extends Model
{
    use HasFactory;
    protected $table="solicitudes_presupuestos";
    //Vinculo con la clave primaria de la tabla
    protected $primaryKey=('SolicitudPresupuestoID');
    public $timestamps = false;//inhabilita los timestamps
}
