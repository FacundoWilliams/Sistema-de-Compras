<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud_Presupuesto extends Model
{
    use HasFactory;
    protected $table="solicitud_presupuesto";
    //Vinculo con la clave primaria de la tabla
    protected $primaryKey=('SolicitudPresupuestoID');
    public $timestamps = false;//inhabilita los timestamps}
}
