<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        {
            // Debido a que en la base de datos guardamos la ruta para ver el archivo, modificamos
            // la ruta para guardar el archivo, por ejemplo:
            // Para ver el archivo (y lo que esta guardado en la base de datos): public/raiz/Estrategicos
            // Pero para guardar el archivo tenemos que tener:                   storage/app/public/Estrategicos
            // Esto debido a la distribucion de los directorios, los cuales estan explicados en el archivo LEEME.md
            // Ademas de que la funcion makeDirectory por defecto se ubica en la ruta storage/app
            $ubicacion = str_replace('raiz/', '', $grupo->Ubicacion);
            Storage::makeDirectory($ubicacion);
        }
    }
}
