<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Proveedores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        schema::create('proveedores', function(Blueprint $table){
            $table->id('ProveedorID');
            $table->integer('Activo')->default(1);
            $table->string('Nombre',50);
            $table->string('Razon_social',25);
            $table->string('Cuit',11);
            $table->string('Condicion_Iva',50);
            $table->string('Direccion',50);
            $table->string('Telefono',20);
            $table->string('Mail',256);
            $table->string('Localidad',25);
            $table->string('Provincia',50);
            //$table->timestamps();//crea 2 columnas creat_At update_at save hora y fecha de creacion y update
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        schema::dropIfExists('proveedores');
    }
}
