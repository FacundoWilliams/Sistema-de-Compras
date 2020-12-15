<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_Presupuesto extends Model
{
    use HasFactory;
    protected $table="detalles_presupuestos";
    public $timestamps = false;//inhabilita los timestamps
}
