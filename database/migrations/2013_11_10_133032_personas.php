<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Personas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        schema::create('personas', function(Blueprint $table){
            $table->integer('Legajo')->primary('Legajo');
            $table->string('Nombre',50);
            $table->string('Apellido',50);
            $table->string('DNI',8);
            $table->string('Cuil',13);
            $table->string('telefono',20);
            $table->string('Mail',256);
            $table->string('Direccion',50);
            $table->integer('Activo')->default(1);
            $table->timestamps();//crea 2 columnas creat_At update_at save hora y fecha de creacion y update
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        schema::dropIfExists('personas');
    }
}
