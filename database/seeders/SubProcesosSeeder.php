<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Clase para llenar la tabla 'SubProcesos' con los valores predefinidos
 *
 */
class SubProcesosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fecha = date('Y-m-d');
        $datos = [
            // SubProcesos de los Procesos Estrategicos
            [
                ['Nombre' => 'Planificación del Programa de Estudios', 'Ubicacion' => 'Estrategicos/ProgramaEstudio', 'FechaCreacion' => $fecha],
                ['Nombre' => 'Gestión de Perfil de Egresado',          'Ubicacion' => 'Estrategicos/PerfilEgresado',  'FechaCreacion' => $fecha]
            ],

            // SubProcesos de los Procesos Misionales
            [
                ['Nombre' => 'Enseñanza y Aprendizaje',   'Ubicacion' => 'Misionales/EnseAprendizaje', 'FechaCreacion' => $fecha],
                ['Nombre' => 'I + D + I',                 'Ubicacion' => 'Misionales/IDI',             'FechaCreacion' => $fecha],
                ['Nombre' => 'Responsabilidad Social',    'Ubicacion' => 'Misionales/RespSocial',      'FechaCreacion' => $fecha],
                ['Nombre' => 'Docencia',                  'Ubicacion' => 'Misionales/Docencia',        'FechaCreacion' => $fecha],
                ['Nombre' => 'Seguimiento a Estudiantes', 'Ubicacion' => 'Misionales/SegEstudiantes',  'FechaCreacion' => $fecha],
                ['Nombre' => 'Seguimiento a Egresados',   'Ubicacion' => 'Misionales/SegEgresados',    'FechaCreacion' => $fecha]
            ],
            
            // SubProcesos de los Procesos de Apoyo
            [
                ['Nombre' => 'Bienestar Universitario',          'Ubicacion' => 'Apoyo/Bienestar',      'FechaCreacion' => $fecha],
                ['Nombre' => 'Recursos Humanos',                 'Ubicacion' => 'Apoyo/RecHumanos',     'FechaCreacion' => $fecha],
                ['Nombre' => 'Infraestructura y Mantenimiento',  'Ubicacion' => 'Apoyo/InfraMante',     'FechaCreacion' => $fecha],
                ['Nombre' => 'Gestión Financiera',               'Ubicacion' => 'Apoyo/GestFinanciera', 'FechaCreacion' => $fecha]
            ],

            // SubProcesos de los Procesos de Evaluacion y Control
            [
                ['Nombre' => 'Aseguramiento de Calidad', 'Ubicacion' => 'EvalControl/AsCalidad', 'FechaCreacion' => $fecha]
            ]
        ];

        $procesos = DB::table('Procesos')->get();
        if ($procesos->count() > 0)
        {
            foreach ($procesos as $proceso)
            {
                if ($proceso->Nombre === 'Procesos Estratégicos')
                {
                    $subProcesos = $datos[0];
                    foreach ($subProcesos as $subProceso)
                    {
                        $subProceso['IdProceso'] = $proceso->IdProceso;
                        DB::table('SubProcesos')->insert($subProceso);
                    }
                }
                if ($proceso->Nombre === 'Procesos Misionales')
                {
                    $subProcesos = $datos[1];
                    foreach ($subProcesos as $subProceso)
                    {
                        $subProceso['IdProceso'] = $proceso->IdProceso;
                        DB::table('SubProcesos')->insert($subProceso);
                    }
                }
                if ($proceso->Nombre === 'Procesos de Apoyo')
                {
                    $subProcesos = $datos[2];
                    foreach ($subProcesos as $subProceso)
                    {
                        $subProceso['IdProceso'] = $proceso->IdProceso;
                        DB::table('SubProcesos')->insert($subProceso);
                    }
                }
                if ($proceso->Nombre === 'Procesos de Evaluación y Control')
                {
                    $subProcesos = $datos[3];
                    foreach ($subProcesos as $subProceso)
                    {
                        $subProceso['IdProceso'] = $proceso->IdProceso;
                        DB::table('SubProcesos')->insert($subProceso);
                    }
                }
            }
        }
    }
}
