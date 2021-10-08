<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Clase para llenar la tabla 'Estandares' con los valores predefinidos
 *
 */
class EstandaresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fecha = date('Y-m-d');
        $estandares = [
            ['Numero' => 1, 'Nombre' => 'Uno',          'FechaCreacion' => $fecha],
            ['Numero' => 2, 'Nombre' => 'Dos',          'FechaCreacion' => $fecha],
            ['Numero' => 3, 'Nombre' => 'Tres',          'FechaCreacion' => $fecha],
            ['Numero' => 4, 'Nombre' => 'Cuatro',          'FechaCreacion' => $fecha],
            ['Numero' => 5, 'Nombre' => 'Cinco',          'FechaCreacion' => $fecha],
            ['Numero' => 6, 'Nombre' => 'Seis',          'FechaCreacion' => $fecha],
            ['Numero' => 7, 'Nombre' => 'Siete',          'FechaCreacion' => $fecha],
            ['Numero' => 8, 'Nombre' => 'Ocho',          'FechaCreacion' => $fecha],
            ['Numero' => 9, 'Nombre' => 'Nueve',          'FechaCreacion' => $fecha],
            ['Numero' => 10, 'Nombre' => 'Diez',          'FechaCreacion' => $fecha],
            ['Numero' => 11, 'Nombre' => 'Once',          'FechaCreacion' => $fecha],
            ['Numero' => 12, 'Nombre' => 'Doce',          'FechaCreacion' => $fecha],
            ['Numero' => 13, 'Nombre' => 'Trece',          'FechaCreacion' => $fecha],
            ['Numero' => 15, 'Nombre' => 'Quince',          'FechaCreacion' => $fecha],
            ['Numero' => 18, 'Nombre' => 'DiecOcho',          'FechaCreacion' => $fecha],
            ['Numero' => 19, 'Nombre' => 'DiecNueve',          'FechaCreacion' => $fecha],
            ['Numero' => 20, 'Nombre' => 'Veinte',          'FechaCreacion' => $fecha],
            ['Numero' => 21, 'Nombre' => 'VeinUno',          'FechaCreacion' => $fecha],
            ['Numero' => 23, 'Nombre' => 'VeinTres',          'FechaCreacion' => $fecha],
            ['Numero' => 24, 'Nombre' => 'VeinCuatro',          'FechaCreacion' => $fecha],
            ['Numero' => 25, 'Nombre' => 'VeinCinco',          'FechaCreacion' => $fecha],
            ['Numero' => 28, 'Nombre' => 'VeinOcho',          'FechaCreacion' => $fecha],
            ['Numero' => 31, 'Nombre' => 'TreiUno',          'FechaCreacion' => $fecha],
            ['Numero' => 33, 'Nombre' => 'TreiTres',          'FechaCreacion' => $fecha],
            ['Numero' => 34, 'Nombre' => 'TreiCuatro',          'FechaCreacion' => $fecha],
        ];
        foreach ($estandares as $estandar)
            DB::table('Estandares')->insert($estandar);
    }
}
