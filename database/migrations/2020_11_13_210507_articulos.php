<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Articulos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        schema::create('articulos', function(Blueprint $table){
            $table->id('ArticuloID');
            $table->integer('Activo')->default(1);
            $table->string('Descripcion',50);
            $table->string('Tipo_embalaje',25);
            $table->string('Unidad_medida',20);
            $table->integer('Unidad_bulto')->nullable();
            $table->integer('Punto_pedido');
            $table->integer('Stock_disponible');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        schema::dropIfExists('articulos');
    }
}
