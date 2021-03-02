<?php

use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('/proyecto')->group(function () {
        Route::get('/get', [ProyectoController::class, 'index']);
        Route::post('/store', [ProyectoController::class, 'store']);
        Route::put('/update', [ProyectoController::class, 'update']);
        Route::put('/update-estado-proyecto', [ProyectoController::class, 'updateEstadoProyecto']);
        Route::post('/store-candidato-supervisor', [ProyectoController::class, 'storeCandidatoSupervisor']);
        Route::post('/store-candidato-interventor', [ProyectoController::class, 'storeCandidatoInterventor']);
        Route::post('/store-candidato-contratista', [ProyectoController::class, 'storeCandidatoContratista']);
});
Route::prefix('/historia')->group(function () {
        Route::get('/get', [HistoryController::class, 'index']);
});
Route::prefix('/user')->group(function () {
        Route::get('/get', UserController::class);
});
