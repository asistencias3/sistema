<?php
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Links directos, solo para pruebas
Route::view('/','index')->name('index');
// Asistencia
Route::view('/asistencia/index','asistencia.asistencia')->name('asistencia.index');
Route::view('/asistencia/edit','asistencia.edit')->name('asistencia.edit');
//Informes
Route::view('/informes/index','informes.informes')->name('informes.index');
//Notificaciones
Route::view('/notificaciones/index','notificaciones.notificaciones')->name('notificaciones.index');
//Permisos
Route::view('/permisos/index','permisos.permisos')->name('permisos.index');
//QR
Route::view('/qr/index','qr.qr')->name('qr.index');
//Usuarios
Route::view('/usuarios/index','usuarios.usuarios')->name('usuarios.index');
