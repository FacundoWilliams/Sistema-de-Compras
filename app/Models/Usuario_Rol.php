<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario_Rol extends Model
{
    use HasFactory;
    protected $table="usuarios_roles";
    
    public $timestamps = false;//inhabilita los timestamps
}
