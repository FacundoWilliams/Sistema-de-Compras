<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Sectores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        schema::create('sectores', function(Blueprint $table){
            $table->id('SectorID');
            //$table->string('PermisoID')->unique();
            $table->string('Descripcion',50);
            $table->Integer('Persona_a_cargo');
            $table->timestamps();//crea 2 columnas creat_At update_at save hora y fecha de creacion y update
            $table->integer('Activo')->default(1);
            $table->foreign('Persona_a_cargo')->references('Legajo')->on('personas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        schema::dropIfExists('sectores');
    }
}
