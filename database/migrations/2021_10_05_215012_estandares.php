<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migracion para la gestion de la tabla 'Estandares'
 *
 */
class Estandares extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Estandares', function (Blueprint $tabla)
        {
            $tabla->id('IdEstandar');
            $tabla->integer('Numero');
            $tabla->string('Nombre');
            $tabla->date('FechaCreacion');
            $tabla->integer('Estado')->default(1);

            //$tabla->primary('IdEstandar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Estandares');
    }
}
