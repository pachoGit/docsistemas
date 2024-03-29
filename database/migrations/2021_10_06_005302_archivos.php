<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migracion para la gestion de la tabla 'Archivos'
 *
 */
class Archivos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Archivos', function (Blueprint $tabla)
        {
            $tabla->id('IdArchivo');
            $tabla->unsignedBigInteger('IdDocumento')->nullable();
            $tabla->string('Nombre')->nullable();
            $tabla->text('UbicacionVirtual')->nullable();
            $tabla->unsignedInteger('Version')->nullable();
            $tabla->string('MotivoCambio', 510)->nullable();
            $tabla->date('FechaCreacion')->nullable();
            $tabla->date('FechaAprobacion')->nullable();
            $tabla->date('FechaModificacion')->nullable();
            $tabla->date('FechaEmision')->nullable(); // Fecha que se encuentra en el documento
            $tabla->string('ResolucionAprobacion')->nullable();
            $tabla->string('ResolucionRectificacion')->nullable();
            $tabla->date('FechaRectificacion')->nullable();
            $tabla->string('DocumentoReferencia')->nullable();
            $tabla->string('IdUsuario')->nullable();
            $tabla->integer('Estado')->default(1);

            $tabla->foreign('IdDocumento')->references('IdDocumento')->on('Documentos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Archivos');
    }
}
