<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\JornadaController;


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
