<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DatabaseController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/db/obtenerInformacion/', [DatabaseController::class, 'obtenerInformacion']);
Route::post('/db/alimentarServidor/', [DatabaseController::class, 'alimentarServidor']);
Route::post('/db/subirInfoAlserver/', [DatabaseController::class, 'subirInfoAlserver']);
