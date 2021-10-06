<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migracion para la gestion de la tabla 'Procesos'
 *
 */
class Procesos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Procesos', function (Blueprint $tabla)
        {
            $tabla->id('IdProceso');
            $tabla->string('Nombre');
            $tabla->string('Ubicacion')->nullable();
            $tabla->date('FechaCreacion');
            $tabla->integer('Estado')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Procesos');
    }
}
