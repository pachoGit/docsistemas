<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migracion para la gestion de la tabla 'Documentos'
 *
 */
class Documentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Documentos', function (Blueprint $tabla)
        {
            $tabla->id('IdDocumento');
            $tabla->unsignedBigInteger('IdGrupoDocumento')->nullable();
            $tabla->unsignedBigInteger('IdTipoDocumento')->nullable();
            $tabla->unsignedBigInteger('IdUnidad')->nullable();
            $tabla->string('Codigo')->nullable();
            $tabla->string('Nombre')->nullable();
            $tabla->string('UbicacionVirtual', 510)->nullable(); // Considerar a cambiar a tipo "text"
            $tabla->string('UbicacionFisica')->nullable();
            $tabla->unsignedInteger('Version')->nullable();
            $tabla->text('MotivoEliminado')->nullable();
            $tabla->date('FechaAprovacion')->nullable();
            $tabla->date('FechaCreacion')->nullable();
            $tabla->integer('Estado')->default(1);

            $tabla->foreign('IdGrupoDocumento')->references('IdGrupoDocumento')->on('GrupoDocumentos');
            $tabla->foreign('IdTipoDocumento')->references('IdTipoDocumento')->on('TipoDocumento');
            $tabla->foreign('IdUnidad')->references('IdUnidad')->on('Unidades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Documentos');
    }
}
