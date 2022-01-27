<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Clase para llenar la tabla 'Procesos' con los valores predefinidos
 */
class ProcesosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fecha = date('Y-m-d');
        $procesos = [
            ['Nombre' => 'Procesos Estratégicos',            'Ubicacion' => 'Estrategicos', 'FechaCreacion' => $fecha],
            ['Nombre' => 'Procesos Misionales',              'Ubicacion' => 'Misionales',   'FechaCreacion' => $fecha],
            ['Nombre' => 'Procesos de Apoyo',                'Ubicacion' => 'Apoyo',        'FechaCreacion' => $fecha],
            ['Nombre' => 'Procesos de Evaluación y Control', 'Ubicacion' => 'EvalControl',  'FechaCreacion' => $fecha]
        ];
        foreach ($procesos as $proceso)
            DB::table('Procesos')->insert($proceso);
    }
}
