<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Clase para llenar la tabla 'Unidades' con los valores predefinidos
 *
 */
class UnidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fecha = date('Y-m-d');
        $unidades = [
            ['Nombre' => 'Dirección de Escuela Profesional',            'FechaCreacion' => $fecha],
            ['Nombre' => 'Comité de Calidad',                           'FechaCreacion' => $fecha],
            ['Nombre' => 'Comisión de Planificación y Presupuesto',     'FechaCreacion' => $fecha],
            ['Nombre' => 'Unidad de Investigación',                     'FechaCreacion' => $fecha],
            ['Nombre' => 'Unidad de Responsabilidad Social',            'FechaCreacion' => $fecha],
            ['Nombre' => 'Departamento Académico',                      'FechaCreacion' => $fecha],
            ['Nombre' => 'Dirección de Asuntos y Servicios Académicos', 'FechaCreacion' => $fecha],
            ['Nombre' => 'Decanato',                                    'FechaCreacion' => $fecha]
        ];
        foreach ($unidades as $unidad)
            DB::table('Unidades')->insert($unidad);
    }
}
