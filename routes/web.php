<?php

use App\Http\Controllers\ProyectoController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/proyecto', function () {
    return Inertia::render('Proyecto');
})->name('proyecto');
Route::middleware(['auth:sanctum', 'verified'])->get('/historia', function () {
    return Inertia::render('Historia');
})->name('historia');
Route::middleware(['auth:sanctum', 'verified'])->get('/configurar-proyecto/{proyecto?}', function () {
    return Inertia::render('ConfiguracionProyecto');
})->name('configurar.proyecto');
