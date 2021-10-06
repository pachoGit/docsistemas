<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migracion para la gestion de la tabla 'SubProcesos'
 *
 */
class SubProcesos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SubProcesos', function (Blueprint $tabla)
        {
            $tabla->id('IdSubProceso');
            $tabla->unsignedBigInteger('IdProceso');
            $tabla->string('Nombre');
            $tabla->string('Ubicacion');
            $tabla->date('FechaCreacion');
            $tabla->integer('Estado')->default(1);

            //$tabla->primary('IdSubProceso');
            $tabla->foreign('IdProceso')->references('IdProceso')->on('Procesos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('SubProcesos');
    }
}
