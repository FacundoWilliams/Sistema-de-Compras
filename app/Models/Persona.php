<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    //le digo al modelo que tabla quiero que administre
    protected $table="personas";
    protected $primaryKey = 'Legajo';

}
