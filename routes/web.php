<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Inicio;
use App\Http\Controllers\Archivo;
use App\Http\Controllers\SubProceso;
use App\Http\Controllers\GrupoDocumentos;
use App\Http\Controllers\Documentos;

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

Route::get('archivo', [Archivo::class, 'index'])->name('archivo-index');
Route::post('archivo', [Archivo::class, 'guardar'])->name('archivo-guardar');

//Route::get('subproceso', [SubProceso::class, 'index']);
Route::get('subproceso/{IdSubProceso}', [SubProceso::class, 'verGrupoDocumentos'])->name('subproceso-versubprocesos');

Route::post('grupo/crear/{IdSubProceso}', [GrupoDocumentos::class, 'crear'])->name('grupo-crear');
Route::post('grupo/editar/{IdGrupoDocumento}', [GrupoDocumentos::class, 'editar'])->name('grupo-editar');
Route::get('grupo/eliminar/{IdGrupoDocumento}', [GrupoDocumentos::class, 'eliminar'])->name('grupo-eliminar');

/* Documentos */

Route::get('documentos/todos/{IdGrupoDocumento}', [Documentos::class, 'todos'])->name('documentos-todos');
Route::post('documentos/crear/{IdGrupoDocumento}', [Documentos::class, 'crear'])->name('documentos-crear');

Route::get('documentos/vistacrear/{IdGrupoDocumento}', [Documentos::class, 'vistaCrear'])->name('documentos-vcrear');

/* Fin Documentos */
