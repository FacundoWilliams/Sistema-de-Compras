<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OrdenesCompras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        schema::create('ordenes_compras', function(Blueprint $table){
            $table->id('OrdenCompraID');
            $table->date('FechaRegistro');
            $table->decimal('Total');
            $table->unsignedBiginteger('ProveID');	     
            $table->unsignedBiginteger('PresuID');
            $table->unsignedBiginteger('SoliCompraID');
            $table->foreign('ProveID')->references('ProveedorID')->on('proveedores');
            $table->foreign('PresuID')->references('PresupuestoID')->on('presupuestos');
            $table->foreign('SoliCompraID')->references('SolicitudCompraID')->on('solicitud_compras');

        });   
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        schema::dropIfExists('ordenes_compras');
    }
}
