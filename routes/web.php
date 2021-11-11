<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Inicio;
use App\Http\Controllers\SubProceso;
use App\Http\Controllers\GrupoDocumentos;
use App\Http\Controllers\Documentos;
use App\Http\Controllers\Archivos;

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

//Route::get('subproceso', [SubProceso::class, 'index']);
Route::get('subproceso/{IdSubProceso}', [SubProceso::class, 'verGrupoDocumentos'])->name('subproceso-versubprocesos');

Route::post('grupo/crear/{IdSubProceso}', [GrupoDocumentos::class, 'crear'])->name('grupo-crear');
Route::post('grupo/editar/{IdGrupoDocumento}', [GrupoDocumentos::class, 'editar'])->name('grupo-editar');
Route::get('grupo/eliminar/{IdGrupoDocumento}', [GrupoDocumentos::class, 'eliminar'])->name('grupo-eliminar');

/* Documentos */

Route::get('documentos/todos/{IdGrupoDocumento}', [Documentos::class, 'todos'])->name('documentos-todos');
Route::post('documentos/crear/{IdGrupoDocumento}', [Documentos::class, 'crear'])->name('documentos-crear');
Route::get('documentos/ver/{IdDocumento}', [Documentos::class, 'ver'])->name('documentos-ver');
Route::post('documentos/editar/{IdDocumento}', [Documentos::class, 'editar'])->name('documentos-editar');
Route::post('documentos/eliminar/{IdDocumento}', [Documentos::class, 'eliminar'])->name('documentos-eliminar');

Route::get('documentos/vistacrear/{IdGrupoDocumento}', [Documentos::class, 'vistaCrear'])->name('documentos-vcrear');
Route::get('documentos/vistaditar/{IdDocumento}', [Documentos::class, 'vistaEditar'])->name('documentos-veditar');

/* Fin Documentos */

/* Archivos */
Route::get('archivos/todos/{IdDocumento}', [Archivos::class, 'todos'])->name('archivos-todos');

/* Fin Archivos */
