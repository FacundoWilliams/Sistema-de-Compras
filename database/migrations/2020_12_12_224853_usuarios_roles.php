<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsuariosRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        schema::create('usuarios_roles', function(Blueprint $table){
            $table->string('RolID',50);
            $table->unsignedBigInteger('UsuarioID');
            $table->dateTime('FechaHoraRegistro');
            $table->foreign('RolID')->references('RolID')->on('roles');
            $table->foreign('UsuarioID')->references('id')->on('users');
            $table->primary(['RolID','UsuarioID']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        schema::dropIfExists('usuarios_roles');
    }
}
