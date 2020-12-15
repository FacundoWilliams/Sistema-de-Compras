<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado_Presupuestos extends Model
{
    use HasFactory;
    protected $table="estados_presupuestos";
    public $timestamps = false;//inhabilita los timestamps
}
