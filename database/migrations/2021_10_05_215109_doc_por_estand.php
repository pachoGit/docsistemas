<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migracion para la gestion de la tabla 'DocPorEstand'
 *
 */
class DocPorEstand extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DocPorEstand', function (Blueprint $tabla)
        {
            $tabla->id('IdDocPorEstand');
            $tabla->unsignedBigInteger('IdDocumento');
            $tabla->unsignedBigInteger('IdEstandar');
            $tabla->date('FechaCreacion');
            $tabla->integer('Estado')->default(1);

            $tabla->foreign('IdDocumento')->references('IdDocumento')->on('Documentos');
            $tabla->foreign('IdEstandar')->references('IdEstandar')->on('Estandares');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('DocPorEstand');
    }
}
