<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EstadosPresupuestos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        schema::create('estados_presupuestos', function(Blueprint $table){
            $table->string('EstadoID');
            $table->unsignedBiginteger('PresupuestoID');
            $table->unsignedBiginteger('AdminComprasID');
            $table->dateTime('FechaHora');
            $table->foreign('PresupuestoID')->references('PresupuestoID')->on('presupuestos');
            $table->foreign('AdminComprasID')->references('id')->on('users');
            $table->foreign('EstadoID')->references('EstadoID')->on('estados');
            $table->primary(['EstadoID','PresupuestoID']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        schema::dropIfExists('estados_presupuestos');
    }
}
