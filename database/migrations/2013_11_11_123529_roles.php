<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Roles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        schema::create('roles', function(Blueprint $table){
            $table->string('RolID',50)->primary('RolID');
            //$table->string('RolID')->unique();
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
        schema::dropIfExists('roles');
    }
}
