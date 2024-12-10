<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Jornada;
use App\Models\Asistencia;
use Carbon\Carbon;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    public function index()
    {
        $usuarios = User::whereDoesntHave('empleado')->get();
    
        return view('Empleados.Index', compact('usuarios'));
    }
    
    public function buscarAsistenciasEmp(Request $request)
{
    $user = auth()->user();
    $rol = $user->role;
    $empleado = $user->empleado; 

    if (!$empleado) {
        return redirect()->route('Empleados.dashboard')->with('error', 'Empleado no encontrado.');
    }

    // Buscar las asistencias del empleado autenticado
    $asistencias = Asistencia::where('id_empleado', $empleado->id) // Filtra las asistencias por ID de empleado
                             ->where('estado', 1) 
                             ->with('empleadoSucursal') 
                             ->get();

    return view('Empleados.asistencias', compact('asistencias', 'rol', 'empleado'));
}
public function buscarInAsistenciasEmp(Request $request)
{
    $user = auth()->user();
    $rol = $user->role;
    $empleado = $user->empleado; // Obtener el empleado relacionado al usuario

    // Si no existe el empleado, muestra un mensaje de error
    if (!$empleado) {
        return redirect()->route('Empleados.dashboard')->with('error', 'Empleado no encontrado.');
    }

    $asistencias = Asistencia::where('id_empleado', $empleado->id) 
                             ->where('estado', 0) 
                             ->with('empleadoSucursal') 
                             ->get();

    return view('Empleados.inasistencias', compact('asistencias', 'rol', 'empleado'));
}


public function storeAsistencias(Request $request)
{
    $user = auth()->user();
    $empleado = $user->empleado;

    if (!$empleado) {
        return redirect()->route('login')->with('error', 'Debes estar logueado como empleado.');
    }

    $validated = $request->validate([
        'hora_salida' => 'required|date_format:H:i',
        'hora_segunda_entrada' => 'nullable|date_format:H:i',
        'hora_segunda_salida' => 'nullable|date_format:H:i',
    ]);

    // Generar las fechas y horas completas para insertar en el formato correcto
    $fechaActual = now()->format('Y-m-d'); // Fecha de hoy
    $horaEntradaCompleta = now()->format('Y-m-d H:i:s'); // Hora actual completa
    $horaSalidaCompleta = $fechaActual . ' ' . $validated['hora_salida'] . ':00';
    $horaSegundaEntradaCompleta = $validated['hora_segunda_entrada'] ? $fechaActual . ' ' . $validated['hora_segunda_entrada'] . ':00' : null;
    $horaSegundaSalidaCompleta = $validated['hora_segunda_salida'] ? $fechaActual . ' ' . $validated['hora_segunda_salida'] . ':00' : null;

    // Insertar en la base de datos
    Asistencia::create([
        'id_empleado' => $empleado->id,
        'fecha' => $fechaActual,
        'hora_entrada' => $horaEntradaCompleta,
        'hora_salida' => $horaSalidaCompleta,
        'hora_segunda_entrada' => $horaSegundaEntradaCompleta,
        'hora_segunda_salida' => $horaSegundaSalidaCompleta,
        'estado' => 1,
    ]);

    return redirect()->route('empleado.asistencia')->with('success', 'Asistencia registrada exitosamente.');
}



public function asistenciasR(Request $request)
{
    // Recuperar los parámetros de la URL
    $jornadaId = $request->query('jornada_id');
    $horaSalida = $request->query('hora_salida');

    // Opcional: Recuperar datos relacionados a la jornada si es necesario
    $jornada = Jornada::find($jornadaId);

    return view('Empleados.asistenciasR', compact('jornadaId', 'horaSalida', 'jornada'));
}



    public function create()
    {
        $usuarios = User::whereDoesntHave('empleado')->get();
    
        return view('Empleados.Create', compact('usuarios'));
    }
    public function store(Request $request)
{
    $validated = $request->validate([
        'id_usuario' => 'required|exists:users,id',
        'direccion' => 'required|string|max:255',
        'telefono' => 'required|string|max:15',
        'sucursal' => 'required|string|max:100',
    ]);

    Empleado::create([
        'id_usuario' => $validated['id_usuario'],
        'direccion' => $validated['direccion'],
        'telefono' => $validated['telefono'],
        'sucursal' => $validated['sucursal'],
    ]);

    return redirect()->route('empleado.index')->with('success', 'Empleado registrado correctamente.');
}

    
public function generarPdfAsistencias()
{
    $user = auth()->user();
    $empleado = $user->empleado;

    if (!$empleado) {
        return redirect()->route('Empleados.dashboard')->with('error', 'Empleado no encontrado.');
    }

    $asistencias = Asistencia::where('id_empleado', $empleado->id)
                             ->where('estado', 1)
                             ->get();

    $pdf = Pdf::loadView('Empleados.PDFasistencias', compact('asistencias'));
    return $pdf->download('asistencias.pdf');
}

public function generarPdfInasistencias()
{
    $user = auth()->user();
    $empleado = $user->empleado;

    if (!$empleado) {
        return redirect()->route('Empleados.dashboard')->with('error', 'Empleado no encontrado.');
    }

    $inasistencias = Asistencia::where('id_empleado', $empleado->id)
                                ->where('estado', 0)
                                ->get();

    $pdf = Pdf::loadView('Empleados.PDFinasistencias', compact('inasistencias'));
    return $pdf->download('inasistencias.pdf');
}

}
