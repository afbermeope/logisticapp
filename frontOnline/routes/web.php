<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\DetalleTurnoController;

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
Route::resource('detalleTurno', DetalleTurnoController::class);

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('persona', PersonaController::class);
    Route::resource('evento', EventoController::class);
    Route::resource('cargo', CargoController::class);

    // Route::get('/activity/program/{id}', [ActivityController::class, 'programView']);
    // Route::post('/home/showServiceOrder/', [HomeController::class, 'showServiceOrder']);
    
});

