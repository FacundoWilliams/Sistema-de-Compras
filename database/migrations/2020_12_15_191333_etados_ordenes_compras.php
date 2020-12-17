<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EtadosOrdenesCompras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        schema::create('estados_ordenes_compras', function(Blueprint $table){
            $table->string('EstadoID');
            $table->unsignedBiginteger('OrdenCompraID');
            $table->unsignedBiginteger('AdminComprasID');
            $table->dateTime('FechaHora');
            $table->unsignedBiginteger('IDAprobador')->nullable();
            $table->foreign('IDAprobador')->references('id')->on('users');
            $table->foreign('OrdenCompraID')->references('OrdenCompraID')->on('ordenes_compras');
            $table->foreign('AdminComprasID')->references('id')->on('users');
            $table->foreign('EstadoID')->references('EstadoID')->on('estados');
            $table->primary(['EstadoID','OrdenCompraID']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        schema::dropIfExists('estados_ordenes_compras');
    }
}
