<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\AsistenciaEController;
use App\Http\Controllers\AsistenciaRHController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\JornadaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificacionInasistencia;
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
    Route::get('/inasistencias/justificar', [AsistenciaController::class, 'inasistencias'])->name('inasistencias.index');
    Route::post('/inasistencias/justificar/{asistenciaId}', [AsistenciaController::class, 'justificarInasistencia'])->name('inasistencias.justificar');
    




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

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index'); // Listar usuarios
        Route::get('/create', [UserController::class, 'create'])->name('create'); // Formulario de creación
        Route::post('/', [UserController::class, 'store'])->name('store'); // Guardar usuario
        Route::get('/{user}', [UserController::class, 'show'])->name('show'); // Mostrar un usuario
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit'); // Formulario de edición
        Route::put('/{user}', [UserController::class, 'update'])->name('update'); // Actualizar usuario
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy'); // Eliminar usuario (soft delete si aplica)
    });

    Route::get('/historial', function () {
        return view('historial_asistencias.Index');
    })->name('historial');
    
Route::post('/asistencia/registrar', [AsistenciaController::class, 'registrar'])->name('asistencia.registrar');


});//final de admin
});//final del midleware de admin




Route::middleware(['auth', 'role:3'])->group(function () {

    Route::group(['prefix' => 'Empleados'], function() {
        Route::get('/dashboard', function () {
            return view('Empleados.dashboard');
        })->name('Empleados.dashboard');
    Route::get('/asistencias', [EmpleadoController::class, 'buscarAsistenciasEmp'])->name('empleado.asistencia');
    Route::get('/inasistencias', [EmpleadoController::class, 'buscarInAsistenciasEmp'])->name('empleado.inasistencia');

    
});


});


Route::middleware(['auth', 'role:2'])->group(function () {

    Route::group(['prefix' => 'RH'], function() {
    
        Route::get('/dashboard', [UsDashboordsController::class, 'RHDashboard'])->name('RH.dashboard');
    
        Route::prefix('asistencias')->name('asistencias.')->group(function () {
            Route::get('/', [AsistenciaRHController::class, 'index'])->name('index');
            Route::get('/create', [AsistenciaRHController::class, 'create'])->name('create');
            Route::post('/', [AsistenciaRHController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [AsistenciaRHController::class, 'edit'])->name('edit');
            Route::put('/{id}', [AsistenciaRHController::class, 'update'])->name('update');
            Route::delete('/{id}', [AsistenciaRHController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('inasistencias')->group(function () {
            Route::get('/filtro-pdf', [AsistenciaRHController::class, 'filtroPdfI'])->name('inasistencias.filtroPdf');
            Route::get('/generar-pdf', [AsistenciaRHController::class, 'generarPdfI'])->name('inasistencias.generarPdf');
            Route::post('/get-empleados', [AsistenciaRHController::class, 'getEmpleadosPorRolI'])->name('inasistencias.getEmpleados');
    
    
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
    
        Route::post('/asistencia/registrar', [AsistenciaRHController::class, 'registrar'])->name('asistencia.registrar');


        Route::get('asistencias/filtro-pdf', [AsistenciaRHController::class, 'filtroPdf'])->name('asistencias.filtroPdf');
        Route::get('asistencias/generar-pdf', [AsistenciaRHController::class, 'generarPdf'])->name('asistencias.generarPdf');
        Route::post('/get-empleados', [AsistenciaRHController::class, 'getEmpleadosPorRol'])->name('get.empleados');
        Route::get('/inasistencias', [AsistenciaRHController::class, 'mostrarInasistenciasView'])->name('inasistencias.view');
        Route::post('/inasistencias', [AsistenciaRHController::class, 'obtenerInasistencias'])->name('inasistencias.post');
        Route::get('/inasistencias/justificar', [AsistenciaRHController::class, 'inasistencias'])->name('inasistencias.indexRH');
        Route::post('/inasistencias/justificar/{asistenciaId}', [AsistenciaRHController::class, 'justificarInasistencia'])->name('inasistencias.justificar');
    });
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//Route::view('sign_in', 'usuarios.signIn')->name('usuario.signIn');
//Route::view('login_prueba', 'usuarios.login')->name('usuario.loginPrueba');
//Route::view('forgot_password', 'usuarios.forgot_password')->name('usuario.forgotPassword');
require __DIR__ . '/auth.php';
