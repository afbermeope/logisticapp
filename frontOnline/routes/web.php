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
use App\Http\Controllers\ElementoController;
use App\Http\Controllers\MovimientoController;
use App\Http\Controllers\DatabaseController;
use App\Http\Controllers\Auth\LoginController;

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


Auth::routes();
Route::get('/', [CabeceraController::class, 'seleccionarEvento']);
Route::get('/logout', [LoginController::class, 'logout']);
Route::get('/registrarMovimiento/{evento_id}', [CabeceraController::class, 'registrarMovimientoView']);


Route::post('/cabecera/agregarMovimiento/', [CabeceraController::class, 'agregarMovimiento']);
Route::post('/cabecera/consultarCabeceras/', [CabeceraController::class, 'consultarCabeceras']);
Route::resource('elemento', ElementoController::class);


Route::group(['middleware' => 'auth'], function () {

    Route::resource('evento', EventoController::class);
    Route::resource('zona', ZonaController::class);
    Route::resource('tarifa', TarifaController::class);
    Route::resource('cargo', CargoController::class);
    Route::resource('persona', PersonaController::class);
    Route::resource('detalleTurno', DetalleTurnoController::class);
    Route::resource('movimiento', MovimientoController::class);
    Route::resource('cabecera', CabeceraController::class);

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/eventos/{id}/agregarZona', [EventoController::class, 'agregarZonaView']);
    Route::get('/cargos/{id}/agregarTarifa', [CargoController::class, 'agregarTarifaView']);
    Route::get('/evento/getZonas/{evento_id}', [EventoController::class, 'getZonas']);
    Route::get('/cargo/getTarifas/{cargo_id}', [CargoController::class, 'getTarifas']);
    Route::get('/db', [DatabaseController::class, 'index']);
    Route::get('/db/bajarInformacion/', [DatabaseController::class, 'bajarInformacion']);

    Route::post('/eventos/agregarZona/', [EventoController::class, 'agregarZona']);
    Route::post('/cargos/agregarTarifa/', [CargoController::class, 'agregarTarifa']);
    Route::post('/cabecera/subirExcel/', [CabeceraController::class, 'subirExcel']);
    
});

