<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RolesPermisos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        schema::create('roles_permisos', function(Blueprint $table){
            $table->string('RolID');
            $table->string('PermisoID');
            $table->dateTime('FechaHoraRegistro');
            $table->foreign('RolID')->references('RolID')->on('roles');
            $table->foreign('PermisoID')->references('PermisoID')->on('permisos');
            $table->primary(['RolID','PermisoID']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        schema::dropIfExists('roles_permisos');
    }
}
