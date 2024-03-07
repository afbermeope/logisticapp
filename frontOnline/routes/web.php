<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\DetalleTurnoController;
use App\Http\Controllers\ZonaController;
use App\Http\Controllers\TarifaController;
use App\Http\Controllers\CabeceraController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/prueba', function () {
    return view('prueba');
});

Auth::routes();
// Route::resource('detalleTurno', DetalleTurnoController::class);

// Route::group(['middleware' => 'auth'], function () {

    Route::resource('evento', EventoController::class);
    Route::resource('zona', ZonaController::class);
    Route::resource('tarifa', TarifaController::class);
    Route::resource('cargo', CargoController::class);
    Route::resource('persona', PersonaController::class);
    Route::resource('detalleTurno', DetalleTurnoController::class);
    Route::resource('cabecera', CabeceraController::class);

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/eventos/{id}/agregarZona', [EventoController::class, 'agregarZonaView']);
    Route::get('/cargos/{id}/agregarTarifa', [CargoController::class, 'agregarTarifaView']);
    
    Route::post('/eventos/agregarZona/', [EventoController::class, 'agregarZona']);
    Route::post('/cargos/agregarTarifa/', [CargoController::class, 'agregarTarifa']);
// });

