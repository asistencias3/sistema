<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\JornadaController;
use App\Http\Controllers\UsDashboordsController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/index', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('index');

    //todo esto va a ser para admin necesito agregar los roles***************agrege un yield  en el app para separar los contenidos de cada uno
    Route::get('/dashboard', function () {
        $user = auth()->user();
        
        switch ($user->rol) {
            case 1:
                return redirect()->route('Administrador.dashboard');
            case 3:
                return redirect()->route('Empleados.dashboard');
            case 2:
                return redirect()->route('RH.dashboard');

            default:
                return redirect('/')->with('error', 'Rol no válido.');
        }
    
    })->middleware(['auth', 'verified'])->name('dashboard');
    
    Route::middleware(['auth', 'role:1'])->group(function () {

Route::group(['prefix' => 'Administrador'], function() {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('Administrador.dashboard');
    //Route::get('/dashboard', [UsDashboordsController::class, 'AdminDashboard'])->name('Administrador.dashboard');

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


    Route::get('/historial', function () {
        return view('historial_asistencias.Index');
    })->name('historial');

});
});


Route::middleware(['auth', 'role:3'])->group(function () {

    Route::group(['prefix' => 'Empleados'], function() {
        Route::get('/dashboard', function () {
            return view('Empleados.dashboard');
        })->name('Empleados.dashboard');
});
});


Route::middleware(['auth', 'role:2'])->group(function () {

    Route::group(['prefix' => 'RH'], function() {
    
        Route::get('/dashboard', [UsDashboordsController::class, 'RHDashboard'])->name('RH.dashboard');
    
    });
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
