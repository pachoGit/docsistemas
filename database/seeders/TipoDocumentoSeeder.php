<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Clase para llenar la tabla 'TipoDocumento' con los valores predefinidos
 *
 */
class TipoDocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fecha = date('Y-m-d');
        $tipos = [
            ['Nombre' => 'NOR',  'Descripcion' => 'NOR',   'FechaCreacion' => $fecha],
            ['Nombre' => 'ACT',  'Descripcion' => 'ACT',   'FechaCreacion' => $fecha],
            ['Nombre' => 'INS',  'Descripcion' => 'INS',   'FechaCreacion' => $fecha],
            ['Nombre' => 'DOC',  'Descripcion' => 'DOC',   'FechaCreacion' => $fecha],
            ['Nombre' => 'INF',  'Descripcion' => 'INF',   'FechaCreacion' => $fecha],
            ['Nombre' => 'REG',  'Descripcion' => 'REG',   'FechaCreacion' => $fecha], 
            ['Nombre' => 'ASS',  'Descripcion' => 'ASS',   'FechaCreacion' => $fecha], 
            ['Nombre' => 'ENC',  'Descripcion' => 'ENC',   'FechaCreacion' => $fecha], 
            ['Nombre' => 'OTRO', 'Descripcion' => 'OTRO',  'FechaCreacion' => $fecha], 
            ['Nombre' => 'IG',   'Descripcion' => 'IG',    'FechaCreacion' => $fecha], 
        ];
        foreach ($tipos as $tipo)
            DB::table('TipoDocumento')->insert($tipo);
    }
}
