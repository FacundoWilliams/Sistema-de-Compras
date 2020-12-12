<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DetallesPresupuestos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        schema::create('detalles_presupuestos', function(Blueprint $table){
            $table->unsignedBiginteger('ArticuloID');
            $table->unsignedBiginteger('PresupuestoID');
            $table->integer('Cantidad');
            $table->float('PrecioUnitario');
            $table->float('Descuento')->nullable();	          
            $table->foreign('SoliPresuID')->references('PresupuestoID')->on('presupuestos');
            $table->foreign('ArticuloID')->references('ArticuloID')->on('articulos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        schema::dropIfExists('detalles_presupuestos');
    }
}
