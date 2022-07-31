<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MercadoriasController;

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

Route::get('/', [MercadoriasController::class, 'index']);
Route::get('/mercadorias/buscarMercadorias', [MercadoriasController::class, 'buscarMercadorias']);
Route::get('/mercadorias/buscarCategorias', [MercadoriasController::class, 'buscarCategorias']);
Route::get('/mercadorias/create', [MercadoriasController::class, 'create']);
Route::get('/mercadorias/edit/{id}', [MercadoriasController::class, 'edit']);
Route::post('/mercadorias/store', [MercadoriasController::class, 'store']);
Route::post('/mercadorias/storexml', [MercadoriasController::class, 'storexml']);
Route::put('/mercadorias/update', [MercadoriasController::class, 'update']);
Route::delete('/mercadorias/delete/{id}', [MercadoriasController::class, 'delete']);