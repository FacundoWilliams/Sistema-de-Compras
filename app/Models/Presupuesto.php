<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presupuesto extends Model
{
    use HasFactory;
    protected $table="presupuestos";
    //Vinculo con la clave primaria de la tabla
    protected $primaryKey=('PresupuestoID');
    public $timestamps = false;//inhabilita los timestamps
}
