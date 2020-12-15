<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado_Orden_Compra extends Model
{
    use HasFactory;
    protected $table="estados_ordenes_compras";
    public $timestamps = false;//inhabilita los timestamps
}
