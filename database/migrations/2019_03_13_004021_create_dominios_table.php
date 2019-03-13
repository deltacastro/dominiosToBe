<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDominiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dominios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('periodicidad_id');
            $table->integer('proveedor_id');
            $table->string('nombre', 50);
            $table->string('descripcion', 255);
            $table->float('costo',10,2);
            $table->date('fechaRegistro');
            $table->date('fechaExpiracion');
            $table->boolean('estatus')->default(true);
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dominios');
    }
}
