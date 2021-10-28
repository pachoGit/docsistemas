<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
/**
 * Migracion para la gestion de la tabla 'Unidades'
 *
 */
class Unidades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Unidades', function (Blueprint $tabla)
        {
            $tabla->id('IdUnidad');
            $tabla->string('Nombre')->nullable();
            $tabla->date('FechaCreacion')->nullable();
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
        Schema::dropIfExists('Unidades');
    }
}
