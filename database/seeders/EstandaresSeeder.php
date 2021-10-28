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
            ['Numero' => 1, 'Nombre' => 'Propósitos articulados',                                          'FechaCreacion' => $fecha],
            ['Numero' => 2, 'Nombre' => 'Participación de los grupo de interés',                           'FechaCreacion' => $fecha],
            ['Numero' => 3, 'Nombre' => 'Revisión periódica y participativa de las políticas y objetivos', 'FechaCreacion' => $fecha],
            ['Numero' => 4, 'Nombre' => 'Sostenibilidad',                                                  'FechaCreacion' => $fecha],
            ['Numero' => 5, 'Nombre' => 'Pertinencia del perfil de egreso',                                'FechaCreacion' => $fecha],
            ['Numero' => 6, 'Nombre' => 'Revisión del perfil de egreso',                                   'FechaCreacion' => $fecha],
            ['Numero' => 7, 'Nombre' => 'Sistema de gestión de la calidad',                                'FechaCreacion' => $fecha],
            ['Numero' => 8, 'Nombre' => 'Planes de mejora',                                                'FechaCreacion' => $fecha],
            ['Numero' => 9, 'Nombre' => 'Plan de estudios',                                                'FechaCreacion' => $fecha],
            ['Numero' => 10, 'Nombre' => 'Características del plan de estudios',                           'FechaCreacion' => $fecha],
            ['Numero' => 11, 'Nombre' => 'Enfoque por competencias',                                       'FechaCreacion' => $fecha],
            ['Numero' => 12, 'Nombre' => 'Articulación con I+D+i y responsabilidad social',                'FechaCreacion' => $fecha],
            ['Numero' => 13, 'Nombre' => 'Movilidad',                                                      'FechaCreacion' => $fecha],
            ['Numero' => 14, 'Nombre' => 'Selección, evaluación, capacitación y perfeccionamiento',        'FechaCreacion' => $fecha],
            ['Numero' => 15, 'Nombre' => 'Plana docente adecuada',                                         'FechaCreacion' => $fecha],
            ['Numero' => 16, 'Nombre' => 'Reconocimiento de las actividades de labor docente',             'FechaCreacion' => $fecha],
            ['Numero' => 17, 'Nombre' => 'Plan de desarrollo académico del docente',                       'FechaCreacion' => $fecha],
            ['Numero' => 18, 'Nombre' => 'Admisión al programa de estudios',                               'FechaCreacion' => $fecha],
            ['Numero' => 19, 'Nombre' => 'Nivelación de ingresantes',                                      'FechaCreacion' => $fecha],
            ['Numero' => 20, 'Nombre' => 'Seguimiento al desempeño de los estudiantes',                    'FechaCreacion' => $fecha],
            ['Numero' => 21, 'Nombre' => 'Actividades extracurriculares',                                  'FechaCreacion' => $fecha],
            ['Numero' => 22, 'Nombre' => 'Gestión y calidad de la I+D+i realizada por docentes',           'FechaCreacion' => $fecha],
            ['Numero' => 23, 'Nombre' => 'I+D+i para la obtención del grado y el título',                  'FechaCreacion' => $fecha],
            ['Numero' => 24, 'Nombre' => 'Publicaciones de los resultados de I+D+i',                       'FechaCreacion' => $fecha],
            ['Numero' => 25, 'Nombre' => 'Responsabilidad social',                                         'FechaCreacion' => $fecha],
            ['Numero' => 26, 'Nombre' => 'Implementación de políticas ambientales',                        'FechaCreacion' => $fecha],
            ['Numero' => 27, 'Nombre' => 'Bienestar',                                                      'FechaCreacion' => $fecha],
            ['Numero' => 28, 'Nombre' => 'Equipamiento y uso de la infraestructura',                       'FechaCreacion' => $fecha],
            ['Numero' => 29, 'Nombre' => 'Mantenimiento de la infraestructura',                            'FechaCreacion' => $fecha],
            ['Numero' => 30, 'Nombre' => 'Sistema de información y comunicación',                          'FechaCreacion' => $fecha],
            ['Numero' => 31, 'Nombre' => 'Centros de información y referencia',                            'FechaCreacion' => $fecha],
            ['Numero' => 32, 'Nombre' => 'Recursos humanos para la gestión del programa de estudios',      'FechaCreacion' => $fecha],
            ['Numero' => 33, 'Nombre' => 'Logro de competencias',                                          'FechaCreacion' => $fecha],
            ['Numero' => 34, 'Nombre' => 'Seguimiento a egresados y objetivos educacionales',              'FechaCreacion' => $fecha]
        ];
        foreach ($estandares as $estandar)
            DB::table('Estandares')->insert($estandar);
    }
}
