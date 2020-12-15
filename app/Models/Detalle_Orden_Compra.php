<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_Orden_Compra extends Model
{
    use HasFactory;
    protected $table="detalles_orden_compra";
    public $timestamps = false;//inhabilita los timestamps
}
