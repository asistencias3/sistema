<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\JornadaController;


Route::prefix('inasistencias')->group(function () {
    Route::get('/filtro-pdf', [AsistenciaController::class, 'filtroPdfI'])->name('inasistencias.filtroPdf');
    Route::get('/generar-pdf', [AsistenciaController::class, 'generarPdfI'])->name('inasistencias.generarPdf');
    Route::post('/get-empleados', [AsistenciaController::class, 'getEmpleadosPorRolI'])->name('inasistencias.getEmpleados');
});

Route::get('asistencias/filtro-pdf', [AsistenciaController::class, 'filtroPdf'])->name('asistencias.filtroPdf');
Route::get('asistencias/generar-pdf', [AsistenciaController::class, 'generarPdf'])->name('asistencias.generarPdf');
Route::post('/get-empleados', [AsistenciaController::class, 'getEmpleadosPorRol'])->name('get.empleados');
Route::get('/inasistencias', [AsistenciaController::class, 'mostrarInasistenciasView'])->name('inasistencias.view');
Route::post('/inasistencias', [AsistenciaController::class, 'obtenerInasistencias'])->name('inasistencias.post');


Route::prefix('asistencias')->name('asistencias.')->group(function () {
    Route::get('/', [AsistenciaController::class, 'index'])->name('index');
    Route::get('/create', [AsistenciaController::class, 'create'])->name('create');
    Route::post('/', [AsistenciaController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [AsistenciaController::class, 'edit'])->name('edit');
    Route::put('/{id}', [AsistenciaController::class, 'update'])->name('update');
    Route::delete('/{id}', [AsistenciaController::class, 'destroy'])->name('destroy');
});

Route::prefix('empleado')->name('empleado.')->group(function () {
    Route::get('/', [EmpleadoController::class, 'index'])->name('index');
    Route::get('/create', [EmpleadoController::class, 'create'])->name('create');
    Route::post('/', [EmpleadoController::class, 'store'])->name('store'); // Importante
});
Route::prefix('jornadas')->name('jornada.')->group(function () {
    Route::get('/', [JornadaController::class, 'index'])->name('index');
    Route::get('/create', [JornadaController::class, 'create'])->name('create');
    Route::post('/', [JornadaController::class, 'store'])->name('store');
    Route::get('/{id}', [JornadaController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [JornadaController::class, 'edit'])->name('edit');
    Route::put('/{id}', [JornadaController::class, 'update'])->name('update');
    Route::delete('/{id}', [JornadaController::class, 'destroy'])->name('destroy');
});


Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/historial', function () {
    return view('historial_asistencias.Index');
})->name('historial');

Route::get('/dashboard', function () {
    return view('layouts.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
