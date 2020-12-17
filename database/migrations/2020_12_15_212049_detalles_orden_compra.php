<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DetallesOrdenCompra extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        schema::create('detalles_orden_compra', function(Blueprint $table){
            $table->unsignedBiginteger('ArticuloID');
            $table->unsignedBiginteger('OrdenCompraID');
            $table->integer('Cantidad');
            $table->integer('PrecioUnitario');
            $table->float('Descuento')->nullable();	          
            $table->foreign('ArticuloID')->references('ArticuloID')->on('articulos');
            $table->foreign('OrdenCompraID')->references('OrdenCompraID')->on('ordenes_compras');
            $table->primary(['ArticuloID','OrdenCompraID']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        schema::dropIfExists('detalles_orden_compra');
    }
}
