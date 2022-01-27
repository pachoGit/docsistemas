<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Util;

/**
 * Clase para llenar la tabla 'GrupoDocumentos' con los valores predefinidos
 *
 */
class GrupoDocumentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fecha = date('Y-m-d');
        $subProcesos = DB::table('SubProcesos')->get();
        foreach ($subProcesos as $subProceso)
        {
            $datos = [
                [
                    'IdSubProceso' => $subProceso->IdSubProceso,
                    'Nombre'       => 'Otros',
                    'Descripcion'  => 'Miscelanea de documentos',
                    'Ubicacion'    => $subProceso->Ubicacion . '/Otros',
                    'FechaCreacion' => $fecha
                ],
                [
                    'IdSubProceso' => $subProceso->IdSubProceso,
                    'Nombre'       => 'Todos',
                    'Descripcion'  => 'Todos los documentos del proceso de ' . $subProceso->Nombre,
                    'Ubicacion'    => $subProceso->Ubicacion . '/Todos',
                    'FechaCreacion' => $fecha
                ]
            ];
            foreach ($datos as $data)
                DB::table('GrupoDocumentos')->insert($data);
        }
        
        $grupos = DB::table('GrupoDocumentos')->get();
        foreach ($grupos as $grupo)
            if (!Util::crearCarpeta(public_path('raiz/' . $grupo->Ubicacion)))
                echo 'No se ha creado la carpeta ' . 'raiz/' . $grupo->Ubicacion . "\n";
    }
}
