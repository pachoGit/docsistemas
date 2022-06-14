<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Database\Seeders\ProcesosSeeder;
use Database\Seeders\SubProcesosSeeder;
use Database\Seeders\UnidadesSeeder;
use Database\Seeders\EstandaresSeeder;
use Database\Seeders\TipoDocumentoSeeder;
use Database\Seeders\GrupoDocumentosSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ProcesosSeeder::class,
            SubProcesosSeeder::class,
            UnidadesSeeder::class,
            EstandaresSeeder::class,
            TipoDocumentoSeeder::class,
            GrupoDocumentosSeeder::class
        ]);
    }
}
