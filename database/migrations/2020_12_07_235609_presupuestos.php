<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Presupuestos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        schema::create('presupuestos', function(Blueprint $table){
            $table->id('PresupuestoID');
            $table->date('FechaRegistro');
            $table->date('FechaValidez');          
	        $table->date('FechaEntregaEstimada');
            $table->decimal('Total');
            $table->unsignedBiginteger('ProveID');	     
            $table->unsignedBiginteger('SoliPresuID');
            $table->foreign('SoliPresuID')->references('SolicitudPresupuestoID')->on('solicitudes_presupuestos');
            $table->foreign('ProveID')->references('ProveedorID')->on('proveedores');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        schema::dropIfExists('presupuestos');
    }
}
