<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Permisos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        schema::create('permisos', function(Blueprint $table){
            $table->string('PermisoID',50)->primary('PermisoID');
            //$table->string('PermisoID')->unique();
            $table->string('Descripcion');
            $table->string('PathAuth');
            $table->timestamps();//crea 2 columnas creat_At update_at save hora y fecha de creacion y update
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        schema::dropIfExists('permisos');
    }
}
