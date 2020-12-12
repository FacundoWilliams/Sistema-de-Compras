<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol_Permiso extends Model
{
    use HasFactory;
    protected $table="roles_permisos";
    public $timestamps = false;//inhabilita los timestamps
}
