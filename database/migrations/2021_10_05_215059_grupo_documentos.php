<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migracion para la gestion de la tabla 'GrupoDocumentos'
 *
 */
class GrupoDocumentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('GrupoDocumentos', function (Blueprint $tabla)
        {
            $tabla->id('IdGrupoDocumento');
            $tabla->unsignedBigInteger('IdSubProceso');
            $tabla->string('Nombre');
            $tabla->string('Ubicacion');
            $tabla->date('FechaCreacion');
            $tabla->integer('Estado')->default(1);

            //$tabla->primary('IdGrupoDocumento');
            $tabla->foreign('IdSubProceso')->references('IdSubProceso')->on('SubProcesos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('GrupoDocumentos');
    }
}
