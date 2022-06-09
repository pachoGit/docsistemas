<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Inicio;
use App\Http\Controllers\SubProceso;
use App\Http\Controllers\GrupoDocumentos;
use App\Http\Controllers\Documentos;
use App\Http\Controllers\Archivos;
use App\Http\Controllers\DocEstandar;
use App\Http\Controllers\DocFecha;
use App\Http\Controllers\DocProcesos;

// Debug
use App\Http\Controllers\Prueba;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [Inicio::class, 'index'])->name('inicio');

Route::get('subproceso',                [SubProceso::class, 'index']);
Route::get('subproceso/{IdSubProceso}', [SubProceso::class, 'verGrupoDocumentos'])->name('subproceso-versubprocesos');

Route::post('grupo/crear/{IdSubProceso}',       [GrupoDocumentos::class, 'crear'])->name('grupo-crear');
Route::post('grupo/editar/{IdGrupoDocumento}',  [GrupoDocumentos::class, 'editar'])->name('grupo-editar');
Route::get('grupo/eliminar/{IdGrupoDocumento}', [GrupoDocumentos::class, 'eliminar'])->name('grupo-eliminar');

/* Documentos */

Route::get('documentos/todos/{IdGrupoDocumento}',  [Documentos::class, 'todos'])->name('documentos-todos');
Route::post('documentos/crear/{IdGrupoDocumento}', [Documentos::class, 'crear'])->name('documentos-crear');
Route::get('documentos/ver/{IdDocumento}',         [Documentos::class, 'ver'])->name('documentos-ver');
Route::post('documentos/editar/{IdDocumento}',     [Documentos::class, 'editar'])->name('documentos-editar');
Route::post('documentos/eliminar/{IdDocumento}',   [Documentos::class, 'eliminar'])->name('documentos-eliminar');
Route::get('documentos/descargar/{IdDocumento}',   [Documentos::class, 'descargar'])->name('documentos-descargar');

Route::get('documentos/vistacrear/{IdGrupoDocumento}', [Documentos::class, 'vistaCrear'])->name('documentos-vcrear');
Route::get('documentos/vistaditar/{IdDocumento}',      [Documentos::class, 'vistaEditar'])->name('documentos-veditar');

/* Fin Documentos */

/* Archivos */
Route::get('archivos/todos/{IdDocumento}',      [Archivos::class, 'todos'])->name('archivos-todos');
Route::post('archivos/crear/{IdDocumento}',     [Archivos::class, 'crear'])->name('archivos-crear');
Route::get('archivos/ver/{IdArchivo}',          [Archivos::class, 'ver'])->name('archivos-ver');
Route::post('archivos/editar/{IdArchivo}',      [Archivos::class, 'editar'])->name('archivos-editar');
Route::get('archivos/eliminar/{IdArchivo}',     [Archivos::class, 'eliminar'])->name('archivos-eliminar');
Route::get('archivos/descargar/{IdArchivo}',    [Archivos::class, 'descargar'])->name('archivos-descargar');
Route::get('archivos/haceractual/{IdArchivo}',  [Archivos::class, 'hacerActual'])->name('archivos-haceractual');

Route::get('archivos/vistacrear/{IdDocumento}', [Archivos::class, 'vistaCrear'])->name('archivos-vcrear');
Route::get('archivos/vistaditar/{IdArchivo}',   [Archivos::class, 'vistaEditar'])->name('archivos-veditar');

/* Fin Archivos */

/* Documentos por estandar */
Route::get('docestandar/todos',                          [DocEstandar::class, 'todos'])->name('docestandar-todos');
Route::get('docestandar/documentos/{IdEstandar}',        [DocEstandar::class, 'documentos'])->name('docestandar-documentos');
Route::get('docestandar/ver/{IdDocumento}/{IdEstandar}', [DocEstandar::class, 'ver'])->name('docestandar-ver');

/* Documentos por fecha */
Route::get('docfecha/inicio',            [DocFecha::class, 'inicio'])->name('docfecha-inicio');
Route::post('docfecha/documentos',       [DocFecha::class, 'documentos'])->name('docfecha-documentos');
Route::get('docfecha/ver/{IdDocumento}', [DocFecha::class, 'ver'])->name('docfecha-ver');

/* Documentos por Procesos */
Route::get('docprocesos/inicio',                        [DocProcesos::class, 'inicio'])->name('docprocesos-inicio');
Route::get('docprocesos/documentos/{IdProceso}',        [DocProcesos::class, 'documentos'])->name('docprocesos-documentos');
Route::get('docprocesos/ver/{IdDocumento}/{IdProceso}', [DocProcesos::class, 'ver'])->name('docprocesos-ver');


// Una ruta para pruebas :D
Route::get('pruebas', [Prueba::class, 'index'])->name('pruebas');

