<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Inicio;
use App\Http\Controllers\Archivo;

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

Route::get('/', [Inicio::class, 'index']);

Route::get('archivo', [Archivo::class, 'index'])->name('archivo-index');
Route::post('archivo', [Archivo::class, 'guardar'])->name('archivo-guardar');
