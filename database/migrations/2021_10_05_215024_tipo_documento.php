<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migracion para la gestion de la tabla 'TipoDocumento'
 *
 */
class TipoDocumento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TipoDocumento', function (Blueprint $tabla)
        {
            $tabla->id('IdTipoDocumento');
            $tabla->string('Nombre');
            $tabla->text('Descripcion');
            $tabla->date('FechaCreacion');
            $tabla->integer('Estado')->default(1);

            //$tabla->primary('IdTipoDocumento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TipoDocumento');
    }
}
